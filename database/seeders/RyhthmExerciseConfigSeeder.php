<?php

namespace Database\Seeders;

use App\Models\RhythmBar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RyhthmExerciseConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (RhythmBar::query()->exists())
            return;

        $path = base_path().'/database/data/primarySchoolRhythmGeneratingDefinitions.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
