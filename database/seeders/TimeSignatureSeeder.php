<?php

namespace Database\Seeders;

use App\Models\RhythmSymbol;
use App\Models\TimeSignature;
use Illuminate\Database\Seeder;

class TimeSignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            [1, [ "base_note" => 4, "num_beats" => 4], 0.6],
            [2, [ "base_note" => 4, "num_beats" => 3], 0.6],
            [3, [ "base_note" => 8, "num_beats" => 6], 0.6],
            [4, [ "base_note" => 4, "num_beats" => 5, "subdivisions" => [[ "d" => 4, "n" => 3], ["d" => 4, "n" => 2]]], 0.2],
            [5, [ "base_note" => 4, "num_beats" => 5, "subdivisions" => [[ "d" => 4, "n" => 2], ["d" => 4, "n" => 3]]], 0.2],
            [6, [ "base_note" => 8, "num_beats" => 9 ], 0.4],
        ];

        foreach ($elements as $element) {
            if (TimeSignature::query()->find($element[0]) == null)
                TimeSignature::query()->firstOrCreate([
                    'id' => $element[0],
                    'value' => $element[1],
                    'probability' => $element[2],
                ]);
        }
    }
}
