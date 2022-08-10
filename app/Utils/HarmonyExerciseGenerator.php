<?php

namespace App\Utils;

use App\Models\HarmonyExercise;
use App\Models\IntervalExercise;
use App\Models\RhythmExercise;

class HarmonyExerciseGenerator extends ExerciseGenerator
{
    const INTEGER_NOTATION = array(
        ChNames::MIN => [0, 3, 7],
        ChNames::MAJ => [0, 4, 7],
        ChNames::DIM => [0, 3, 6],
        ChNames::AUG => [0, 4, 8],
        ChNames::MIN7 => [0, 3, 7, 10],
        ChNames::MAJ7 => [0, 4, 7, 11],
        ChNames::DOM7 => [0, 4, 7, 10],
        ChNames::MIN_MAJ7 => [0, 3, 7, 11],
        ChNames::DIM7 => [0, 3, 6, 9],
        ChNames::HALF_DIM => [0, 3, 6, 10]
    );

    public function generateExercise(): HarmonyExercise
    {
        /* Parameters */
        $razlozeniProbability = $request['razlozen'] / 100;
        $ozkaProbability = $request['ozka'] / 100;

        $chordProbability = array();
        foreach (ChNames::getAll() as $cn) {
            $chordProbability[] = new Chord(
                $cn,
                $request["chord"][$cn]['exists'],
                array(
                    $request["chord"][$cn]['lega1'],
                    $request["chord"][$cn]['lega2'],
                    $request["chord"][$cn]['lega3'],
                )
            );
        }

        $allchordsalneki = array(
            'major' => array(
                'c', 'g', 'd', 'a', 'e', 'b', 'f#', 'db', 'ab', 'eb', 'bb', 'f'
            ),
            'minor' => array(
                'a', 'e', 'b', 'f#', 'c#', 'g#', 'd#', 'bb', 'f', 'c', 'g', 'd'
            )
        );

        /* Generate chords */
        // Pick chord based on its probability (exists)
        $chord = clone $chordProbability[Utils::weightedRandom(
            array_map(
                function ($ch) {
                    return $ch->exists;
                },
                $chordProbability
            )
        )];

        // Pick root
        $rootIndex = rand(0, 11);
        if ($chord->type === ChNames::MIN || $chord->type === ChNames::MIN7 || $chord->type === ChNames::DIM || $chord->type == ChNames::MIN_MAJ7) {
            $root = $allchordsalneki['minor'][$rootIndex];
        } else {
            $root = $allchordsalneki['major'][$rootIndex];
        }

        // TODO use razlozen parameter
        $razlozen = Utils::weightedRandom([1 - $razlozeniProbability, $razlozeniProbability]);

        $kateriObrat = Utils::weightedRandom($chord->obrati);
        if ($kateriObrat >= 0)
            self::obrati($chord->integerNotation, $kateriObrat);

        sort($chord->integerNotation);

        if (Utils::weightedRandom([$ozkaProbability, 1 - $ozkaProbability])) {
            self::siroka($chord->integerNotation);
        }

        sort($chord->integerNotation);

        if ($chord->integerNotation[sizeof($chord->integerNotation) - 1] > 20) {
            for ($i = 0; $i < sizeof($chord->integerNotation); $i++) {
                $chord->integerNotation[$i] = $chord->integerNotation[$i] - 12;
            }
        }

        $chordType = $chord->type;

        $chNames = ChNames::getAll();

        $harmonyExercise = HarmonyExercise::query()->create([
            'exercise_id' => $this->exercise->id,
            'value' => [

            ],
        ]);

        return $harmonyExercise;
    }

    private static function obrati(&$chord, int $n)
    {
        for ($i = 0; $i <= $n; $i++) {
            $chord[$i % sizeof($chord)] = $chord[$i] + 12;
        }
    }

    private static function siroka(&$chord)
    {
        for ($i = 1; $i < sizeof($chord); $i += 2) {
            $chord[$i] = $chord[$i] + 12;
        }
    }
}

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

abstract class ChNames
{
    const MIN = 'min';
    const MAJ = 'maj';
    const DIM = 'dim';
    const AUG = 'aug';
    const MIN7 = 'min7';
    const MAJ7 = 'maj7';
    const DOM7 = 'dom7';
    const MIN_MAJ7 = 'min_maj7';
    const DIM7 = 'dim7';
    const HALF_DIM = 'half_dim';

    static function getAll()
    {
        return [
            self::MIN,
            self::MAJ,
            self::DIM,
            self::AUG,
            self::MIN7,
            self::MAJ7,
            self::DOM7,
            self::MIN_MAJ7,
            self::DIM7,
            self::HALF_DIM,
        ];
    }
}

