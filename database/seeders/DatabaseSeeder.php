<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GameTypeSeeder::class);
        $this->call(DifficultySeeder::class);
        $this->call(RyhthmExerciseConfigSeeder::class);
//        $this->call(TimeSignatureSeeder::class);
//        $this->call(RhythmFeatureSeeder::class);
//        $this->call(RhythmSymbolSeeder::class);
//        $this->call(RhythmFeatureOccurrenceSeeder::class);
//        $this->call(RhythmSymbolOccurrenceSeeder::class);
    }
}
