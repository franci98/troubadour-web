<?php

namespace App\Utils;

use App\Models\Exercise;

abstract class ExerciseGenerator
{
    protected $exercise;

    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    abstract public function generateExercise();
}
