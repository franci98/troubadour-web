<?php

namespace App\Utilities;

use App\Model\Placeholder;
use Carbon\Carbon;

class DataFormInput {

    public $title;
    public $name;
    public $type;
    public $required;
    public $min;
    public $max;
    public $value;
    public $extras;
    public $divSize = 12;
    public $inputSize = 12;
    public $helpTip;
    public $addOn;

    private static function constructBase(string $title, string $name, bool $required, $value = null): DataFormInput {
        $input = new DataFormInput;
        $input->title = $title;
        $input->name = $name;
        $input->required = $required;
        $input->value = $value;
        return $input;
    }

    public static function text(string $title, string $name, bool $required, int $min, int $max, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "text";
        $input->min = $min;
        $input->max = $max;
        return $input;
    }

    public static function info(string $title, $value, $class = ""): DataFormInput {
        $input = self::constructBase($title, '', false, $value);
        $input->type = "info";
        $input->extras["class"] = $class;
        return $input;
    }

    public static function button(string $title, $route, $buttonClass, $containerClass = ""): DataFormInput {
        $input = self::constructBase($title, '', false, $route);
        $input->type = "button";
        $input->extras["class"] = $buttonClass;
        $input->extras["container_class"] = $containerClass;
        $input->extras["route"] = $route;
        return $input;
    }

    public static function textarea(string $title, string $name, bool $required, int $min, int $max, int $rows, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "textarea";
        $input->min = $min;
        $input->max = $max;
        $input->extras["rows"] = $rows;
        return $input;
    }

    public static function email(string $title, string $name, bool $required, int $min, int $max, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "email";
        $input->min = $min;
        $input->max = $max;
        return $input;
    }

    public static function password(string $title, string $name, bool $required, int $min, int $max, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "password";
        $input->min = $min;
        $input->max = $max;
        return $input;
    }

    public static function number(string $title, string $name, bool $required, int $min, int $max, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "number";
        $input->min = $min;
        $input->max = $max;
        return $input;
    }

    public static function color(string $title, string $name, bool $required, ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "color";
        return $input;
    }

    public static function checkbox(string $title, string $name, bool $required, ?string $checked = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $checked);
        $input->type = "checkbox";
        return $input;
    }

    public static function duration(string $title, string $name, bool $required, ?int $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "duration";
        return $input;
    }

    public static function date(string $title, string $name, bool $required, ?Carbon $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "date";
        return $input;
    }

    public static function datetime(string $title, string $name, bool $required, ?Carbon $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "datetime";
        return $input;
    }

    public static function select(string $title, string $name, bool $required, $options, $value = null, bool $multiple = false): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "select";
        $input->extras["options"] = $options;
        $input->extras["multiple"] = $multiple;
        return $input;
    }

    public static function html($value): DataFormInput {
        $input = self::constructBase("", "", false, $value);
        $input->type = "html";
        return $input;
    }

    public static function richtext(string $title, string $name, bool $required, int $min, int $max, array $placeholders = [], ?string $value = null): DataFormInput {
        $input = self::constructBase($title, $name, $required, $value);
        $input->type = "richtext";
        $input->min = $min;
        $input->max = $max;
        $input->extras['placeholders'] = json_encode($placeholders);
        $input->extras['translations'] = json_encode(Placeholder::translate($placeholders));
        return $input;
    }

    public static function file(string $title, string $name, bool $required): DataFormInput {
        $input = self::constructBase($title, $name, $required);
        $input->type = "file";
        return $input;
    }

    public static function component(string $componentName, $data): DataFormInput {
        $input = self::constructBase("", "", false);
        $input->type = "component";
        $input->extras["component_name"] = $componentName;
        $input->extras["data"] = $data;
        return $input;
    }

    // component placed after form
    public static function outsideComponent(string $componentName, $data): DataFormInput {
        $input = self::constructBase("", "", false);
        $input->type = "outsideComponent";
        $input->extras["component_name"] = $componentName;
        $input->extras["data"] = $data;
        return $input;
    }

    public static function hidden(string $title, string $name, $value = null): DataFormInput {
        $input = self::constructBase($title, $name, true, $value);
        $input->name = $name;
        $input->value = $value;
        $input->type = "hidden";
        return $input;
    }


    public function disables(string... $inputs): DataFormInput {
        $this->extras["disables"] = $inputs;
        return $this;
    }

    public function enables(string... $inputs): DataFormInput {
        $this->extras["enables"] = $inputs;
        return $this;
    }

    public function hides(string... $inputs): DataFormInput {
        $this->extras["hides"] = $inputs;
        return $this;
    }

    public function shows(string... $inputs): DataFormInput {
        $this->extras["shows"] = $inputs;
        return $this;
    }

    public function setInputSize(int $size): DataFormInput {
        $this->inputSize = $size;
        return $this;
    }

    public function setDivSize(string $size): DataFormInput {
        $this->divSize = $size;
        return $this;
    }

    public function setTip(string $tip): DataFormInput
    {
        $this->helpTip = $tip;
        return $this;
    }

    public function setAddOn(string $addOn): DataFormInput
    {
        $this->addOn = $addOn;
        return $this;
    }
}
