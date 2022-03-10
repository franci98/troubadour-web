<?php

namespace Database\Seeders;

use App\Models\RhythmFeature;
use Illuminate\Database\Seeder;

class RhythmFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            [1,' Level 11 (4/4) (3/4)', 0],
            [2,' Level 12 (4/4)', 0],
            [3,' Level 13 (4/4)(3/4)(mešano)', 0],
            [4,' Level 14 pavze (4/4)', 0],
            [5,' Level 1 crossbars', 1],
            [6,' Level 11 crossbars (4/4) (3/4)', 1],
            [9,' Level 11 (6/8)', 0],
            [10, 'Level 11 crossbars (6/8)', 1],
            [11, 'Level 12 crossbars (4/4)', 1],
            [12, 'Level 12 (6/8)', 0],
            [13, 'Level 12 crossbar (6/8)', 1],
            [14, 'Level 12 (5/4)', 0],
            [15, 'Level 13 crossbar (4/4)(3/4)(mešano)', 1],
            [16, 'Level 13 (6/8)', 0],
            [17, 'Level 13 (6/8) crossbar', 1],
            [18, 'bar', 1],
            [21, 'F1', 0],
            [22, 'F2', 0],
            [23, 'F3', 0],
            [24, 'F4N', 0],
            [25, 'F4R', 0],
            [26, 'F1 8', 0],
            [27, 'F2 8', 0],
            [28, 'F3 8', 0],
            [29, 'F4N 8', 0],
            [30, 'F4R 8', 0],
            [31, 'F 21 (4/4, 3/4)', 0],
            [32, 'F 21 (6/8, 9/8)', 0],
            [33, 'F 22 (4/4, 3/4)', 0],
            [34, 'F 22 (6/8, 9/8)', 0],
            [35, 'F 23 (4/4, 3/4)', 0],
            [36, 'F 23 (6/8, 9/8)', 0],
            [40, 'Level 31 (1/4)', 0],
            [41, 'Level 31 (3/8)', 0],
            [42, 'Level 32 (3/8)', 0],
            [43, 'Level 32 (1/4)', 0],
            [44, 'Level 33 (3/8)', 0],
            [45, 'Level 33 (1/4)', 0],
            [46, 'Level 34 (1/4)', 0],
            [47, 'Level 34 (3/8)', 0],
        ];

        foreach ($elements as $element) {
            RhythmFeature::query()->firstOrCreate([
                'id' => $element[0],
                'name' => $element[1],
                'is_crossbar' => $element[2],
            ]);
        }
    }
}
