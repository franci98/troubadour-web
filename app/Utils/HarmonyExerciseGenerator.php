<?php

namespace App\Utils;

use App\Models\HarmonyExercise;
use App\Models\IntervalExercise;
use App\Models\RhythmExercise;
use music_theory;

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
        // Get parameters based on difficulty
        $parameters = $this->exercise->game->difficulty->parameters;

        /* Strummed or picked */
        $razlozeniProbability = $parameters['razlozen'] / 100;
        $razlozen = Utils::weightedRandom([1 - $razlozeniProbability, $razlozeniProbability]);

        /*
        Store all chord types (min, maj, dim,...) and their probability for inversion
        and existance into $chords and pick one based on its probability to exist.
         */
        $chords = array();
        foreach (ChNames::getAll() as $cn) {
            $chords[] = new Chord(
                $cn,
                $parameters["chord"][$cn]['exists'],
                array(
                    $parameters["chord"][$cn]['obrat0'],
                    $parameters["chord"][$cn]['obrat1'],
                    $parameters["chord"][$cn]['obrat2'],
                    $parameters["chord"][$cn]['obrat3'] ?? 0,
                )
            );
        }
        $chord = clone $chords[Utils::weightedRandom(
            array_map(
                function ($ch) {
                    return $ch->exists;
                },
                $chords
            )
        )];


        /* Pick one of available root notes (ones that have scales without double accidentals)*/
        $availableRootNotes = array(
            'major' => array(
                'C', 'Db', 'D', 'Eb', 'E', 'F', 'F#', 'G', 'Ab', 'A', 'Bb', 'B'
            ),
            'minor' => array(
                'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'Bb', 'B'
            )
        );
        $majorStruct = [0, 2, 4, 5, 7, 9, 11];
        $minorStruct = [0, 2, 3, 5, 7, 8, 10];

        $rootIndex = rand(0, 11);
        if ($chord->type === ChNames::MIN || $chord->type === ChNames::MIN7 || $chord->type === ChNames::DIM || $chord->type == ChNames::MIN_MAJ7) {
            $root = $availableRootNotes['minor'][$rootIndex];
            $structure = $minorStruct;
        } else {
            $root = $availableRootNotes['major'][$rootIndex];
            $structure = $majorStruct;
        }

        /*  Pick one of the available inversions and invert the chord
            (inversion means you take the bottom note and raise it by an octave (+12)
        */
        $inversion = Utils::weightedRandom($chord->obrati);
        if ($inversion != null)
            self::obrati($chord->integerNotation, $inversion);
        sort($chord->integerNotation);


        /* If the harmony is open increase every other note by an octave (open harmony means more than an octave between first and last note)*/
        $closeHarmonyProbability = $parameters['ozka'] / 100;
        $close = true;
        if (Utils::weightedRandom([$closeHarmonyProbability, 1 - $closeHarmonyProbability])) {
            self::siroka($chord->integerNotation);
            $close = false;
        }
        sort($chord->integerNotation);

        /* If notes are too high lower the whole chord */
        if ($chord->integerNotation[sizeof($chord->integerNotation) - 1] > 20) {
            for ($i = 0; $i < sizeof($chord->integerNotation); $i++) {
                $chord->integerNotation[$i] = $chord->integerNotation[$i] - 12;
            }
        }

        $offsetLookup = [
            'minor' => [
                1 => ['index' => 1, 'append' => 'b'],
                4 => ['index' => 3, 'append' => 'b'],
                6 => ['index' => 4, 'append' => 'b'],
                9 => ['index' => 6, 'append' => 'b'],
                11 => ['index' => 6, 'append' => '#'],
            ],
            'major' => [
                1 => ['index' => 1, 'append' => 'b'],
                3 => ['index' => 2, 'append' => 'b'],
                6 => ['index' => 4, 'append' => 'b'],
                8 => ['index' => 4, 'append' => '#'],
                10 => ['index' => 6, 'append' => 'b'],
            ]
        ];

        $scales = [
            'major' => [
                'C' => ['C', 'D', 'E', 'F', 'G', 'A', 'B'],
                'G' => ['G', 'A', 'B', 'C', 'D', 'E', 'F#'],
                'D' => ['D', 'E', 'F#', 'G', 'A', 'B', 'C#'],
                'A' => ['A', 'B', 'C#', 'D', 'E', 'F#', 'G#'],
                'E' => ['E', 'F#', 'G#', 'A', 'B', 'C#', 'D#'],
                'B' => ['B', 'C#', 'D#', 'E', 'F#', 'G#', 'A#'],
                'F#' => ['F#', 'G#', 'A#', 'B', 'C#', 'D#', 'E#'],
                'Db' => ['Db', 'Eb', 'F', 'Gb', 'Ab', 'Bb', 'C'],
                'Ab' => ['Ab', 'Bb', 'C', 'Db', 'Eb', 'F', 'G'],
                'Eb' => ['Eb', 'F', 'G', 'Ab', 'Bb', 'C', 'D'],
                'Bb' => ['Bb', 'C', 'D', 'Eb', 'F', 'G', 'A'],
                'F' => ['F', 'G', 'A', 'Bb', 'C', 'D', 'E'],
            ],
            'minor' => [
                'A' => ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
                'E' => ['E', 'F#', 'G', 'A', 'B', 'C', 'D'],
                'B' => ['B', 'C#', 'D', 'E', 'F#', 'G', 'A'],
                'F#' => ['F#', 'G#', 'A', 'B', 'C#', 'D', 'E'],
                'C#' => ['C#', 'D#', 'E', 'F#', 'G#', 'A', 'B'],
                'G#' => ['G#', 'A#', 'B', 'C#', 'D#', 'E', 'F#'],
                'D#' => ['D#', 'E#', 'F#', 'G#', 'A#', 'B', 'C#'],
                'Bb' => ['Bb', 'C', 'Db', 'Eb', 'F', 'Gb', 'Ab'],
                'C' => ['C', 'D', 'Eb', 'F', 'G', 'Ab', 'Bb'],
                'F' => ['F', 'G', 'Ab', 'Bb', 'C', 'Db', 'Eb'],
                'G' => ['G', 'A', 'Bb', 'C', 'D', 'Eb', 'F'],
                'D' => ['D', 'E', 'F', 'G', 'A', 'Bb', 'C'],
            ]
        ];

        $keys = [];
        $minorOrMajor = $structure == $minorStruct ? 'minor' : 'major';

        $scale = $scales[$minorOrMajor][$root];

        foreach ($chord->integerNotation as $curr) {
            $octave = floor(($curr + $rootIndex) / 12);

            if ($curr < 0) {
                $octave = -1;
                $curr += 12;
            }

            $curr = $curr % 12;

            $octave = 4 + $octave;

            $index = array_search($curr, $structure);
            $append = '';
            if (!in_array($curr, $structure)) {
                $index = $offsetLookup[$minorOrMajor][$curr]['index'];
                $append = $offsetLookup[$minorOrMajor][$curr]['append'];
            }

            $key = $scale[$index];

            // append b or # (if duplicate remove accidentals).
            if ($append == 'b') $key = self::nizanje($key);
            else if ($append == 'bb') $key = self::nizanje(self::nizanje($key));
            else if ($append == '#') $key = self::visanje($key);

            $key = $key . "/$octave";
            $keys[] = $key;
        }


        $harmonyExercise = HarmonyExercise::query()->create(
            [
                'exercise_id' => $this->exercise->id,
                'value' => [
                    'keys' => $keys,
                    'razlozen' => boolval($razlozen),
                    'root' => $root,
                    'chord_type' => $chord->type,
                    'inversion' => $inversion,
                    'close' => $close,
                ]
            ]
        );

        return $harmonyExercise;
    }

    private static function obrati(&$chord, int $n)
    {
        $n -= 1;
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

    private static function nizanje($key)
    {
        $acc = self::hasAccidental($key);
        if (!$acc || $acc === 'b') {
            //$t = explode('/', $key);
            //return $t[0] . 'b/' . $t[1];
            return $key . 'b';
        }
        return str_replace('#', '', $key);
    }

    private static function visanje($key)
    {
        $acc = self::hasAccidental($key);
        if (!$acc || $acc === '#') {
            //  $t = explode('/', $key);
            // return $t[0] . '#/' . $t[1];
            return $key . '#';
        }
        return $key[0] . str_replace('b', '', substr($key, 1));
    }

    private static function hasAccidental($ch)
    {
        if (str_contains($ch, '#')) return '#';
        if (str_contains(substr($ch, 1), 'b')) return 'b';
        return false;
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
