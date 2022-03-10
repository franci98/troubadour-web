<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use App\Models\RhythmFeatureOccurrence;
use Illuminate\Database\Seeder;

class RhythmFeatureOccurrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            [11,18,1,1],
            [11,18,2,1],
            [11,18,3,1],
            [11,21,1,1],
            [11,21,2,1],
            [11,26,3,1],
            [12,18,1,1],
            [12,18,2,1],
            [12,18,3,1],
            [12,22,1,1],
            [12,22,2,1],
            [12,27,3,1],
        ];

        foreach ($elements as $element) {
            $difficulty = Difficulty::query()->firstWhere('title', $element[0]);
            RhythmFeatureOccurrence::query()->firstOrCreate([
                'difficulty_id' => $difficulty->id,
                'rhythm_feature_id' => $element[1],
                'time_signature_id' => $element[2],
                'probability' => $element[3]
            ]);
        }
    }
}
