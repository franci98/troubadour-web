<?php

namespace App\Utils;

abstract class ExerciseGenerator
{
    protected $options;

    abstract public function setOptions($options);

    abstract public function generateExercise($options);
}
