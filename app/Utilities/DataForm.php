<?php

namespace App\Utilities;

class DataForm {

    public $title;
    public $inputs = [];
    public $method;
    public $route;
    public $cancelRoute;
    public $extras = [];
    public $script;
    public $formButtonTitle;

    public function __construct(string $title, string $method, string $route, string $cancelRoute) {
        $this->title = $title;
        $this->method = $method;
        $this->route = $route;
        $this->cancelRoute = $cancelRoute;
    }

    public static function make(string $title, string $method, string $route, string $cancelRoute): DataForm {
        return new DataForm($title, $method, $route, $cancelRoute);
    }

    public function addInput(DataFormInput $input): DataForm {
        $this->inputs[] = $input;
        return $this;
    }

    public function addExtra(string $name, $value) {
        $this->extras[$name] = $value;
    }

    public function setFormButtonTitle(string $title)
    {
        $this->formButtonTitle = $title;
    }

    public function response() {
        return response()->view("utilities.dataform-page", ["dataForm" => $this, "extras" => $this->extras]);
    }
}
