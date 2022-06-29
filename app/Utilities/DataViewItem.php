<?php

namespace App\Utilities;

class DataViewItem {

    public $title;
    public $viewName;
    public $value;
    public $sizeClasses;
    public $type;
    public $extras = [];

    public $items = [];
    public $objects = [];

    private static function constructBase(string $sizeClasses, string $type): DataViewItem {
        $item = new DataViewItem;
        $item->sizeClasses = $sizeClasses;
        $item->type = $type;
        return $item;
    }

    public static function text(string $title, string $value, string $sizeClasses): DataViewItem {
        $item = self::constructBase($sizeClasses, "text");
        $item->title = $title;
        $item->value = $value;
        return $item;
    }

    public static function boolean(string $title, bool $value, string $sizeClasses): DataViewItem {
        $item = self::constructBase($sizeClasses, "text");
        $item->title = $title;
        $item->value = $value ? __('messages.yes') : __('messages.no');
        return $item;
    }

    public static function status(string $title, string $value, string $sizeClasses): DataViewItem {
        $item = self::constructBase($sizeClasses, "status");
        $item->title = $title;
        $item->value = $value;
        return $item;
    }

    public static function anchor(string $title, string $href, string $sizeClasses, string $classes): DataViewItem {
        $item = self::constructBase($sizeClasses, "anchor");
        $item->title = $title;
        $item->value = $href;
        $item->extras["classes"] = $classes;
        return $item;
    }

    public static function richText(string $title, string $value, string $sizeClasses): DataViewItem {
        $item = self::constructBase($sizeClasses, "richText");
        $item->title = $title;
        $item->value = $value;
        return $item;
    }

    public static function button(string $title, string $value, string $sizeClasses, string $classes = 'btn btn-sm btn-primary'): DataViewItem {
        $item = self::constructBase($sizeClasses, "button");
        $item->title = $title;
        $item->value = $value;
        $item->extras["classes"] = $classes;
        return $item;
    }

    public static function formButton(string $title, string $value, string $sizeClasses, string $classes, array $data, ?string $method = 'POST'): DataViewItem {
        $item = self::constructBase($sizeClasses, "formButton");
        $item->title = $title;
        $item->value = $value;
        $item->extras["classes"] = $classes;
        $item->extras["data"] = $data;
        $item->extras["method"] = $method;
        return $item;
    }

    public static function category(?string $title, string $sizeClasses): DataViewItem {
        $item = self::constructBase($sizeClasses, "category");
        $item->title = $title;
        return $item;
    }

    public static function subCategory(?string $title, string $sizeClasses, bool $borderOnlyText): DataViewItem {
        $item = self::constructBase($sizeClasses, "subCategory");
        $item->title = $title;
        $item->extras["border_only_text"] = $borderOnlyText;
        return $item;
    }

    public static function span(string $value, string $classes, ?string $title = null): DataViewItem {
        $item = self::constructBase("col-auto", "span");
        $item->title = $title;
        $item->value = $value;
        $item->extras["classes"] = $classes;
        return $item;
    }

    public static function component(string $viewName, array $objects, string $sizeClasses="col-12"): DataViewItem {
        $item = self::constructBase($sizeClasses, "component");
        $item->viewName = $viewName;
        $item->objects = $objects;
        return $item;
    }

    public function addItem(DataViewItem $item): DataViewItem {
        $this->items[] = $item;
        return $this;
    }
}
