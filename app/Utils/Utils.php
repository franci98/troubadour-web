<?php

namespace App\Utils;

class Utils
{
    static function weightedRandom($options)
    {
        $sum = 0;
        $rand = rand(0, 1000) / 1000;
        foreach ($options as $option => $probability) {
            $sum += $probability;
            if ($rand <= $sum) {
                return $option;
            }
        }
    }

    static function weightedRandomSelector($options, callable $selector)
    {
        $rand = rand(0, 1000) / 1000;
        $sum = array_sum(array_map($selector, $options));
        $cumsum = 0;
        $vals = array_map(function($el) use(&$sum, &$selector, &$cumsum) {
            $cumsum += $selector($el) / $sum;
            return $cumsum;
        }, $options);
        for($i = 0; $i < count($vals); $i++){
            if ($rand <= $vals[$i]) {
                return $options[$i];
            }
        }
        return null;
    }
}
