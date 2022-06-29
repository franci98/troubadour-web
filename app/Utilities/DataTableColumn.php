<?php

namespace App\Utilities;

class DataTableColumn {

    public $type;
    public $data = [];
    public $valueGetter;

    public $name;
    public $title;
    public $orderable;
    public $searchable;

    private static function constructBase(string $name, string $title, bool $orderable, bool $searchable): DataTableColumn {
        $column = new DataTableColumn;
        $column->name = $name;
        $column->title = $title;
        $column->orderable = $orderable;
        $column->searchable = $searchable;
        return $column;
    }

    public static function text(string $name, string $title, bool $orderable, bool $searchable, callable $valueGetter, ?callable $subtitleGetter = null): DataTableColumn {
        $column = self::constructBase($name, $title, $orderable, $searchable);
        $column->type = "text";
        $column->valueGetter = $valueGetter;
        $column->data["subtitleGetter"] = $subtitleGetter;
        return $column;
    }

    public static function boolean(string $name, string $title, bool $orderable, bool $searchable, callable $valueGetter): DataTableColumn {
        $column = self::constructBase($name, $title, $orderable, $searchable);
        $column->type = "boolean";
        $column->valueGetter = $valueGetter;
        return $column;
    }

    public static function switch(string $name, string $title, callable $valueGetter, callable $linkGetter, string $method, ?callable $authorization = null): DataTableColumn {
        $column = self::constructBase($name, $title, true, false);
        $column->type = "switch";
        $column->valueGetter = $valueGetter;
        $column->data["linkGetter"] = $linkGetter;
        $column->data["method"] = $method;
        $column->data["authorization"] = $authorization;
        return $column;
    }

    public static function component(string $name, string $title, bool $orderable, bool $searchable, string $component, callable $dataGetter): DataTableColumn {
        $column = self::constructBase($name, $title, $orderable, $searchable);
        $column->type = "component";
        $column->data["component"] = $component;
        $column->data["dataGetter"] = $dataGetter;
        return $column;
    }

    public static function actions(): DataTableColumn {
        $column = self::constructBase("actions", __("messages.actions"), false, false);
        $column->type = "actions";
        $column->data["actions"] = [];
        return $column;
    }

    public function addAction(DataTableColumnAction $action): DataTableColumn {
        $this->data["actions"][] = $action;
        return $this;
    }

    public function getAvailableActions($item): array {
        return collect($this->data["actions"])->filter(function ($action) use ($item) { return ($action->policy ? canUser($action->policy, $item) : true) && ($action->condition ? ($action->condition)($item) : true); })->toArray();
    }

    public function showCondensedActions(array $actions): bool {
        return collect($actions)->sum(function ($item) { return mb_strlen($item->title); }) >= 40;
    }

}
