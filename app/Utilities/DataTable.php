<?php

namespace App\Utilities;

use Illuminate\Http\Request;

class DataTable {

    public function __construct(string $title, Request $request, $query) {
        $this->request = $request;
        $this->query = $query;
        $this->title = $title;
        $this->search = $request->get("search");
    }

    public $request;
    public $title;
    public $columns;
    public $query;
    public $cell;
    public $data;
    public $perPage = 20;
    public $buttons = [];
    public $search;
    public $sortingAsc;
    public $sortingDesc;
    public $extras = [];
    public $linkGetter;
    public $linkAuthorizationGetter;

    public static function make(string $title, Request $request, $query): DataTable {
        return new DataTable($title, $request, $query);
    }

    public function addColumn(DataTableColumn $column) {
        $this->columns[] = $column;
    }

    public function addButton(string $href, string $title) {
        $this->buttons[] = [
            "href" => $href,
            "title" => $title,
        ];
    }

    public function addExtra(string $name, $value) {
        $this->extras[$name] = $value;
    }

    public function response() {
        $collectedColumns = collect($this->columns);
        if (isset($this->search) && $collectedColumns->contains("searchable", "===", true)) {
            $search = $this->search;
            $this->query = $this->query->where(function($q) use ($collectedColumns, $search) {
                foreach ($collectedColumns->where("searchable", "===", true) as $column) {
                    $split = explode(".", $column->name);
                    $methods = array_slice($split, 0, count($split) - 1);
                    if (sizeof($split) >= 2) {
                        $q = $q->orWhereHas(implode('.', $methods), function($q) use ($split, $search) {
                            return $q->where($split[count($split) - 1], "like", "%$search%");
                        });
                    } else {
                        $q = $q->orWhere($column->name, "like", "%$search%");
                    }
                }
            });
        }
        $orderable = $collectedColumns->where("orderable")->pluck("name")->toArray();

        if ($this->request->has("sort-asc")) {
            $direction = "asc";
            $key = "sort-asc";
        }
        if ($this->request->has("sort-desc")) {
            $direction = "desc";
            $key = "sort-desc";
        }

        if (in_array($this->request->get("sort-asc"), $orderable) || in_array($this->request->get("sort-desc"), $orderable)) {
            if ($key == "sort-asc") $this->sortingAsc = $this->request->get("sort-asc");
            if ($key == "sort-desc") $this->sortingDesc = $this->request->get("sort-desc");

            $this->query = $this->query->reorder();

            $split = explode(".", $this->request->get($key));
            if (sizeof($split) >= 2) {
                $this->query = $this->query->orderBy(end($split), $direction);
            } else {
                $this->query = $this->query->orderBy($this->request->get($key), $direction);
            }

        }
        $this->data = $this->query->paginate($this->perPage);
        return response()->view("utilities.datatable", ["dataTable" => $this]);
    }

    public function getSortUrl(DataTableColumn $column): string {
        return $this->sortingAsc === $column->name ? $this->request->fullUrlWithQuery(["sort-desc" => $column->name, "sort-asc" => null]) : $this->request->fullUrlWithQuery(["sort-asc" => $column->name, "sort-desc" => null]);
    }

    public function containsSearchable(): bool {
        return collect($this->columns)->contains("searchable", "===", true);
    }

    public function containsButtons(): bool {
        return sizeof($this->buttons) > 0;
    }

    public function setLinkGetter(callable $linkGetter, ?callable $authorizationGetter = null): DataTable {
        $this->linkGetter = $linkGetter;
        $this->linkAuthorizationGetter = $authorizationGetter;
        return $this;
    }
}
