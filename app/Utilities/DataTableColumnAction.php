<?php

namespace App\Utilities;

class DataTableColumnAction {

    public $type;
    public $method = "GET";
    public $title;
    public $linkGetter;
    public $confirmationText;
    public $policy;
    public $condition;

    public static function normal(string $title, callable $linkGetter): DataTableColumnAction {
        $action = new DataTableColumnAction;
        $action->type = "normal";
        $action->title = $title;
        $action->linkGetter = $linkGetter;
        return $action;
    }

    public static function confirmable(string $title, callable $linkGetter, ?string $confirmationText = null): DataTableColumnAction {
        $action = new DataTableColumnAction;
        $action->type = "confirmable";
        $action->title = $title;
        $action->linkGetter = $linkGetter;
        $action->confirmationText = $confirmationText ?? __("messages.really_perform_this_action");
        return $action;
    }

    public static function destructive(string $title, callable $linkGetter, ?string $confirmationText = null): DataTableColumnAction {
        $action = new DataTableColumnAction;
        $action->type = "destructive";
        $action->title = $title;
        $action->linkGetter = $linkGetter;
        $action->method = "DELETE";
        $action->confirmationText = $confirmationText ?? __("messages.really_perform_destructive_action");
        return $action;
    }

    public function setCondition(callable $conditionCheck): DataTableColumnAction {
        $this->condition = $conditionCheck;
        return $this;
    }

    public function setMethod(string $method): DataTableColumnAction {
        $this->method = $method;
        return $this;
    }

    public function setPolicy(string $policy): DataTableColumnAction {
        $this->policy = $policy;
        return $this;
    }
}
