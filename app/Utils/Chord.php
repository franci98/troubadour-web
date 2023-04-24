<?php

namespace App\Utils;

class Chord
{
    public $integerNotation, $exists, $obrati, $type;
    public function __construct($type, $exists, $obrati)
    {
        $this->integerNotation = HarmonyExerciseGenerator::INTEGER_NOTATION[$type];
        $this->exists = $exists;
        $this->obrati = $obrati;
        $this->type = $type;
    }
}
