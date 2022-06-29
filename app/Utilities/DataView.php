<?php

namespace App\Utilities;

use phpDocumentor\Reflection\Types\Boolean;

class DataView {

    public $editRoute;
    public $deleteRoute;
    public $title = null;
    public $items = [];
    public $objects = [];

    public function __construct(?string $editRoute, ?string $deleteRoute) {
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
    }

    public static function make(?string $editRoute = null, ?string $deleteRoute = null): DataView {
        return new DataView($editRoute, $deleteRoute);
    }

    public function addItem(DataViewItem $item): DataView {
        $this->items[] = $item;
        return $this;
    }

    public function addObject(Object $object): DataView {
        $this->objects[] = $object;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function response() {
        return response()->view("utilities.dataview-page", ["dataView" => $this, "objects" => $this->objects]);
    }
}
