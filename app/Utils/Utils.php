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
}
