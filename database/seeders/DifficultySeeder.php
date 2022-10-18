<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\GameType;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulties = [];
        $difficulties[] = [
            'title' => '11',
            'sequence' => 1,
            'description' => '1. letnik - level 1',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '12',
            'sequence' => 2,
            'description' => '1. letnik - level 2',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '13',
            'sequence' => 3,
            'description' => '1. letnik - level 3',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '14',
            'sequence' => 4,
            'description' => '1. letnik - level 4',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '21',
            'sequence' => 1,
            'description' => '2. letnik - level 1',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '22',
            'sequence' => 2,
            'description' => '2. letnik - level 2',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '23',
            'sequence' => 3,
            'description' => '2. letnik - level 3',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '24',
            'sequence' => 4,
            'description' => '2. letnik - level 4',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '31',
            'sequence' => 1,
            'description' => '3. letnik - level 1',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '32',
            'sequence' => 2,
            'description' => '3. letnik - level 2',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '33',
            'sequence' => 3,
            'description' => '3. letnik - level 3',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '34',
            'sequence' => 4,
            'description' => '3. letnik - level 4',
            'game_type_id' => 2
        ];
        $difficulties[] = [
            'title' => '1',
            'sequence' => 1,
            'description' => '1. razred - level 1',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '2',
            'sequence' => 2,
            'description' => '1. razred - level 2',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '3',
            'sequence' => 3,
            'description' => '1. razred - level 3',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '4',
            'sequence' => 4,
            'description' => '1. razred - level 4',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '5',
            'sequence' => 5,
            'description' => '2. razred - level 1',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '6',
            'sequence' => 6,
            'description' => '2. razred - level 2',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '7',
            'sequence' => 7,
            'description' => '2. razred - level 3',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '8',
            'sequence' => 8,
            'description' => '2. razred - level 4',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '9',
            'sequence' => 9,
            'description' => '3. razred - level 1 (cetrtinka s piko, vezaj cetrtink, vezaj cetrtink s piko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '10',
            'sequence' => 10,
            'description' => '3. razred - level 2 (osminski takt + 3 osminke + cetrtinska pavza s piko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '11',
            'sequence' => 11,
            'description' => '3. razred - level 3 (4 sestnajstinke)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '12',
            'sequence' => 12,
            'description' => '3. razred - level 4 (3 sestnajstinke + sestnajstinske pavze)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '13',
            'sequence' => 13,
            'description' => '3. razred - level 5 (6 sestnajstink + 5 sestanjstink + 2 sestnajstinki z osminko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '14',
            'sequence' => 14,
            'description' => '4. razred - level 1 (osminka 2 sestnajstinki osminka)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '15',
            'sequence' => 15,
            'description' => '4. razred - level 2 (triole)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '16',
            'sequence' => 16,
            'description' => '4. razred - level 3 (pavza med 4 sestnajstinke + 4 sestnajstinke z osminko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '17',
            'sequence' => 17,
            'description' => '4. razred - level 4 (osminka s piko sestnajstinka + 2 sestnajstinki osminka 2 sestanjstinki)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '18',
            'sequence' => 18,
            'description' => '5. razred - level 1 (2 sestnajstinki + osminki vezaj na osminko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '19',
            'sequence' => 19,
            'description' => '5. razred - level 2 (sestnajstinka osminka sestnajstinka)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '20',
            'sequence' => 20,
            'description' => '5. razred - level 3 (osminka s piko 3 sestnajstinke + osminka s piko sestnajstinka osminka)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '21',
            'sequence' => 21,
            'description' => '5. razred - level 4 (5/8 7/8 9/8 5/4 + cetrtinka s piko vezaj na cetrtinko)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '22',
            'sequence' => 22,
            'description' => '5. razred - level 5 (triplet cetrtink + celinka + celinka s piko + 3/2 2/2)',
            'game_type_id' => 4
        ];
        $difficulties[] = [
            'title' => '1',
            'sequence' => 1,
            'description' => '1. razred - level 1',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '2',
            'sequence' => 2,
            'description' => '1. razred - level 2',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '3',
            'sequence' => 3,
            'description' => '1. razred - level 3',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '4',
            'sequence' => 4,
            'description' => '1. razred - level 4',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '5',
            'sequence' => 5,
            'description' => '2. razred - level 1',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '6',
            'sequence' => 6,
            'description' => '2. razred - level 2',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '7',
            'sequence' => 7,
            'description' => '2. razred - level 3',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '8',
            'sequence' => 8,
            'description' => '2. razred - level 4',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '9',
            'sequence' => 9,
            'description' => '3. razred - level 1 (cetrtinka s piko, vezaj cetrtink, vezaj cetrtink s piko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '10',
            'sequence' => 10,
            'description' => '3. razred - level 2 (osminski takt + 3 osminke + cetrtinska pavza s piko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '11',
            'sequence' => 11,
            'description' => '3. razred - level 3 (4 sestnajstinke)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '12',
            'sequence' => 12,
            'description' => '3. razred - level 4 (3 sestnajstinke + sestnajstinske pavze)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '13',
            'sequence' => 13,
            'description' => '3. razred - level 5 (6 sestnajstink + 5 sestanjstink + 2 sestnajstinki z osminko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '14',
            'sequence' => 14,
            'description' => '4. razred - level 1 (osminka 2 sestnajstinki osminka)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '15',
            'sequence' => 15,
            'description' => '4. razred - level 2 (triole)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '16',
            'sequence' => 16,
            'description' => '4. razred - level 3 (pavza med 4 sestnajstinke + 4 sestnajstinke z osminko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '17',
            'sequence' => 17,
            'description' => '4. razred - level 4 (osminka s piko sestnajstinka + 2 sestnajstinki osminka 2 sestanjstinki)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '18',
            'sequence' => 18,
            'description' => '5. razred - level 1 (2 sestnajstinki + osminki vezaj na osminko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '19',
            'sequence' => 19,
            'description' => '5. razred - level 2 (sestnajstinka osminka sestnajstinka)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '20',
            'sequence' => 20,
            'description' => '5. razred - level 3 (osminka s piko 3 sestnajstinke + osminka s piko sestnajstinka osminka)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '21',
            'sequence' => 21,
            'description' => '5. razred - level 4 (5/8 7/8 9/8 5/4 + cetrtinka s piko vezaj na cetrtinko)',
            'game_type_id' => 5
        ];
        $difficulties[] = [
            'title' => '22',
            'sequence' => 22,
            'description' => '5. razred - level 5 (triplet cetrtink + celinka + celinka s piko + 3/2 2/2)',
            'game_type_id' => 5
        ];

        $difficulties[] = [
            'title' => 'Nižja glasbena šola - vsi letniki',
            'sequence' => 1,
            'description' => '2 - 4 note, poltonski razpon = 3',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 3, 'min_notes' => 2, 'max_notes' => 4
            ]
        ];
        $difficulties[] = [
            'title' => 'Srednja glasbena šola - 1. letnik',
            'sequence' => 2,
            'description' => '4 - 6 not, poltonski razpon = 5',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 5, 'min_notes' => 4, 'max_notes' => 6
            ]
        ];
        $difficulties[] = [
            'title' => 'Srednja glasbena šola - 2. letnik',
            'sequence' => 3,
            'description' => '4 - 6 not, poltonski razpon = 12',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 12, 'min_notes' => 4, 'max_notes' => 6
            ]
        ];
        $difficulties[] = [
            'title' => 'Srednja glasbena šola - 3. letnik',
            'sequence' => 4,
            'description' => '6 - 8 not, poltonski razpon = 12',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 12, 'min_notes' => 6, 'max_notes' => 8
            ]
        ];
        $difficulties[] = [
            'title' => 'Srednja glasbena šola - 4. letnik',
            'sequence' => 5,
            'description' => '6 - 10 not, poltonski razpon = 12',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 12, 'min_notes' => 6, 'max_notes' => 10
            ]
        ];
        $difficulties[] = [
            'title' => 'Univerzitetni nivo',
            'sequence' => 6,
            'description' => '8 - 10 not, poltonski razpon = 12',
            'game_type_id' => GameType::INTERVALS,
            'parameters' => [
                'range' => 12, 'min_notes' => 8, 'max_notes' => 10
            ]
        ];

        $difficulties[] = [
            'title' => 'Durovi in molovi akordi z obrati',
            'sequence' => 7,
            'description' => 'Durovi in molovi akordi z obrati',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 50,
                "ozka" => 100,
                "chord" => array(
                    "min" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "min7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "dom7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 0,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 1,
                    ),
                    "dim7" => array(
                        "exists" => 0,
                        "obrat0" => 0,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 1,
                    ),
                    "half_dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    )
                ),
                "meja" => 1
            ]
        ];

        $difficulties[] = [
            'title' => 'Zmanjšani in zvišani akordi',
            'sequence' => 8,
            'description' => 'Zmanjšani in zvišani akordi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 50,
                "ozka" => 100,
                "chord" => array(
                    "min" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "dim" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "min7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "dom7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 0,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 1,
                    ),
                    "dim7" => array(
                        "exists" => 0,
                        "obrat0" => 0,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 1,
                    ),
                    "half_dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    )
                ),
                "meja" => 1
            ]
        ];

        $difficulties[] = [
            'title' => 'Sedmi akordi z vsemi obrati',
            'sequence' => 9,
            'description' => 'Sedmi akordi z vsemi obrati',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 50,
                "ozka" => 50,
                "chord" => array(
                    "min" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "min7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "maj7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "dom7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "min_maj7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "dim7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "half_dim" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    )
                ),
                "meja" => 1
            ]
        ];

        $difficulties[] = [
            'title' => 'Molovi in durovi akordi v široki legi',
            'sequence' => 10,
            'description' => 'Molovi in durovi akordi v široki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 50,
                "ozka" => 0,
                "chord" => array(
                    "min" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "min7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "dom7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "dim7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    ),
                    "half_dim" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 1,
                    )
                ),
                "meja" => 1
            ]
        ];


        foreach ($difficulties as $i => $difficulty) {
            $parameters = $difficulty['parameters'] ?? null;
            unset($difficulty['parameters']);
            Difficulty::query()->firstOrCreate($difficulty, ['parameters' => $parameters]);
        }
    }
}
