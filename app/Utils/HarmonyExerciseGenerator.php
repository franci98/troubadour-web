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
        // Get parameters based on difficulty
        $request = array(
            "razlozen" => 0,
            "ozka" => 100,
            "chord" => array(
                "min" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "maj" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "dim" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0,
                ),
                "aug" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "min7" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "maj7" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "dom7" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "min_maj7" => array(
                    "exists" => 1,
                    "lega1" => 1,
                    "lega2" => 1,
                    "lega3" => 0
                ),
                "dim7" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                ),
                "half_dim" => array(
                    "exists" => 0,
                    "lega1" => 1,
                    "lega2" => 0,
                    "lega3" => 0
                )
            ),
            "meja" => 1
        );

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

        $majorScales = [
            'c' => ['c/4', 'd/4', 'e/4', 'f/4', 'g/4', 'a/4', 'b/4'],
            'g' => ['g/4', 'a/4', 'b/4', 'c/5', 'd/5', 'e/5', 'f#/5'],
            'd' => ['d/4', 'e/4', 'f#/4', 'g/4', 'a/4', 'b/4', 'c#/5'],
            'a' => ['a/4', 'b/4', 'c#/5', 'd/5', 'e/5', 'f#/5', 'g#/5'],
            'e' => ['e/4', 'f#/4', 'g#/4', 'a/4', 'b/4', 'c#/5', 'd#/5'],
            'b' => ['b/4', 'c#/5', 'd#/5', 'e/5', 'f#/5', 'g#/5', 'a#/5'],
            'f#' => ['f#/4', 'g#/4', 'a#/4', 'b/4', 'c#/5', 'd#/5', 'e#/5'],
            'db' => ['db/4', 'eb/4', 'f/4', 'gb/4', 'ab/4', 'bb/4', 'c/5'],
            'ab' => ['ab/4', 'bb/4', 'c/5', 'db/5', 'eb/5', 'f/5', 'g/5'],
            'eb' => ['eb/4', 'f/4', 'g/4', 'ab/4', 'bb/4', 'c/5', 'd/5'],
            'bb' => ['bb/4', 'c/4', 'd/5', 'eb/5', 'f/5', 'g/5', 'a/5'],
            'f' => ['f/4', 'g/4', 'a/4', 'bb/4', 'c/5', 'd/5', 'e/5']
        ];

        $minorToMajorRoot = [
            'a' => 'c',
            'e' => 'g',
            'b' => 'd',
            'f#' => 'a',
            'c#' => 'e',
            'g#' => 'b',
            'd#' => 'f#',
            'bb' => 'db',
            'f' => 'ab',
            'c' => 'eb',
            'g' => 'bb',
            'd' => 'f'
        ];

        $majorStruct = [0, 2, 4, 5, 7, 9, 11, 12];

        $structure = $majorStruct;

        if ($chord->type === 'min' || $chord->type === 'dim' || $chord->type === 'min7' || $chord->type === 'min_maj7') {
            $root = $minorToMajorRoot[$root];
        }

        $offsetLookup = array(
            'min' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ]
            ],
            'min7' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ],
                10 => [
                    'index' => 11,
                    'append' => 'b'
                ]
            ],
            'dim' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ],
                6 => [
                    'index' => 7,
                    'append' => 'b'
                ]
            ],
            'aug' => [
                8 => [
                    'index' => 7,
                    'append' => '#'
                ]
            ],
            'dom7' => [
                10 => [
                    'index' => 11,
                    'append' => 'b'
                ]
            ],
            // TODO preglej ce gre skozi vse root note
            'min_maj7' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ]
            ],
            'dim7' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ],
                6 => [
                    'index' => 7,
                    'append' => 'b'
                ],
                9 => [
                    'index' => 11,
                    'append' => 'bb'
                ]
            ],
            'half_dim' => [
                3 => [
                    'index' => 4,
                    'append' => 'b'
                ],
                6 => [
                    'index' => 7,
                    'append' => 'b'
                ],
                10 => [
                    'index' => 11,
                    'append' => 'b'
                ]
            ]
        );

        $keys = [];
        foreach ($chord->integerNotation as $curr) {
            $addToOctave = floor($curr / 12);
            if ($curr < 0) {
                $addToOctave = -1;
                if ($curr < -11)
                    echo ('INT NOTATION IS LESS THAN 11!');
            }

            $curr = $curr % 12;
            $offset = false;
            if ($curr < 0) $curr += 12;
            if (array_key_exists($chord->type, $offsetLookup)) {
                if (array_key_exists($curr, $offsetLookup[$chord->type])) {
                    $offset = $offsetLookup[$chord->type][$curr];
                }
            }
            if (!$offset) {
                $offset = [
                    'index' => $curr,
                    'append' => ''
                ];
            }

            $indexOfNote = array_search($offset['index'], $structure);
            $key = $majorScales[$root][$indexOfNote];

            // append b or # (if duplicate remove accidentals).
            if ($offset['append'] == 'b') $key = self::nizanje($key);
            else if ($offset['append'] == 'bb') $key = self::nizanje(self::nizanje($key));
            else if ($offset['append'] == '#') $key = self::visanje($key);

            $key = substr($key, 0, strlen($key) - 1) . ($key[strlen($key) - 1] + $addToOctave);
            $keys[] = $key;
        }


        $harmonyExercise = HarmonyExercise::query()->create(
            [
                'exercise_id' => $this->exercise->id,
                'value' => [
                    'keys' => $keys,
                    'razlozen' => $razlozen,
                    'root' => $root,
                    'chordType' => $chordType,
                ]
            ]
        );

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

    private static function nizanje($key)
    {
        return $key;
        $acc = self::hasAccidental($key);
        if (!$acc || $acc === 'b') {
            $t = explode('/', $key);
            return $t[0] . 'b/' . $t[1];
        }
        return str_replace('#', '', $key);
    }

    private static function visanje($key)
    {
        return $key;
        $acc = self::hasAccidental($key);
        if (!$acc || $acc === '#') {
            $t = explode('/', $key);
            return $t[0] . '#/' . $t[1];
        }
        return $key[0] + str_replace('b', '', substr($key, 1));
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
