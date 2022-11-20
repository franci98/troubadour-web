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
            'title' => 'Durovi in molovi akordi brez obratov (v ozki legi)',
            'sequence' => 7,
            'description' => 'Durovi in molovi akordi brez obratov (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
                "ozka" => 100,
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
            'title' => 'Durovi in molovi akordi brez obratov (v široki legi)',
            'sequence' => 8,
            'description' => 'Durovi in molovi akordi brez obratov (v široki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
            'title' => 'Durovi in molovi akordi z osnovnim in prvim obratom (v ozki legi)',
            'sequence' => 9,
            'description' => 'Durovi in molovi akordi z osnovnim in prvim obratom (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
                "ozka" => 100,
                "chord" => array(
                    "min" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
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
            'title' => 'Durovi in molovi akordi z osnovnim, prvim in drugim obratom (v ozki legi)',
            'sequence' => 10,
            'description' => 'Durovi in molovi akordi z osnovnim, prvim in drugim obratom (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
            'title' => 'Razloženi durovi in molovi akordi brez obratov (v ozki legi)',
            'sequence' => 11,
            'description' => 'Razoženi durovi in molovi akordi brez obratov (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
                "ozka" => 100,
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
            'title' => 'Razloženi durovi in molovi akordi brez obratov (v široki legi)',
            'sequence' => 12,
            'description' => 'Razloženi durovi in molovi akordi brez obratov (v široki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
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
            'title' => 'Razloženi durovi in molovi akordi z osnovnim in prvim obratom (v ozki legi)',
            'sequence' => 13,
            'description' => 'Razloženi durovi in molovi akordi z osnovnim in prvim obratom (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
                "ozka" => 100,
                "chord" => array(
                    "min" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
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
            'title' => 'Razloženi durovi in molovi akordi z osnovnim, prvim in drugim obratom (v ozki legi)',
            'sequence' => 14,
            'description' => 'Razloženi durovi in molovi akordi z osnovnim, prvim in drugim obratom (v ozki legi)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
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
            'title' => 'Dur, mol, zmanjšani, zvečani akordi z osnovnim in prvim obratom (ozka lega)',
            'sequence' => 15,
            'description' => 'Dur, mol, zmanjšani, zvečani akordi z osnovnim in prvim obratom (ozka lega)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
                "ozka" => 100,
                "chord" => array(
                    "min" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "dim" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 0,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
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
            'title' => 'Dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (ozka lega)',
            'sequence' => 16,
            'description' => 'Dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (ozka lega)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
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
            'title' => 'Razloženi dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (ozka lega)',
            'sequence' => 17,
            'description' => 'Razloženi dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (ozka lega)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
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
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
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
            'title' => 'Dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (široka lega)',
            'sequence' => 18,
            'description' => 'Razloženi dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (ozka lega)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
                "ozka" => 0,
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
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
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
            'title' => 'Razloženi dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (široka lega)',
            'sequence' => 19,
            'description' => 'Razloženi dur, mol, zmanjšani, zvečani akordi z osnovnim, prvim in drugim obratom (široka lega)',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
                "ozka" => 0,
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
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
                        "obrat3" => 0,

                    ),
                    "aug" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 1,
                        "obrat2" => 1,
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
            'title' => 'Dur, mol septakordi osnovni obrat',
            'sequence' => 20,
            'description' => 'Dur, mol septakordi osnovni obrat',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "maj7" => array(
                        "exists" => 1,
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
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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

        $difficulties[] = [
            'title' => 'Dur, mol septakordi z obrati v široki legi',
            'sequence' => 21,
            'description' => 'Dur, mol septakordi z obrati v široki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
                "ozka" => 0,
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
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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


        $difficulties[] = [
            'title' => 'Dur, mol septakordi z obrati v ozki legi',
            'sequence' => 22,
            'description' => 'Dur, mol septakordi z obrati v ozki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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

        $difficulties[] = [
            'title' => 'Razloženi dur, mol septakordi z obrati v ozki legi',
            'sequence' => 23,
            'description' => 'Razloženi dur, mol septakordi z obrati v ozki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
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
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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

        $difficulties[] = [
            'title' => 'Razloženi dur, mol septakordi z obrati v široki legi',
            'sequence' => 23,
            'description' => 'Razloženi dur, mol septakordi z obrati v široki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 100,
                "ozka" => 0,
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
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 0,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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


        $difficulties[] = [
            'title' => 'Ostali septakordi z osnovnim obratom v ozki legi',
            'sequence' => 24,
            'description' => 'Ostali septakordi z osnovnim obratom v ozki legi',
            'game_type_id' => GameType::HARMONIC,
            'parameters' => [
                'razlozen' => 0,
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
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "min_maj7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "dim7" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
                    ),
                    "half_dim" => array(
                        "exists" => 1,
                        "obrat0" => 1,
                        "obrat1" => 0,
                        "obrat2" => 0,
                        "obrat3" => 0,
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

        $firstline = true;
        $sequence = 1;
        $file = fopen(base_path("database/data/interval_difficulties.csv"), 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            if (!$firstline) {
                Difficulty::query()->firstOrCreate(
                    [
                        "title" => "Razpon " . $line[1] . ", št. not " . $line[2] . " - " . $line[3],
                        "description" => "Intervalni razpon " . $line[1] . ", št. not " . $line[2] . " - " . $line[3],
                        "game_type_id" => GameType::INTERVALS,
                        "sequence" => $sequence++,
                    ],
                    [
                        'parameters' => [
                            'range' => intval($line[1]),
                            'min_notes' => intval($line[2]),
                            'max_notes' => intval($line[3]),
                        ]
                    ]
                );
            }
            $firstline = false;
        }
        fclose($file);

    }
}
