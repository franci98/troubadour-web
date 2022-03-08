<?php

namespace Database\Seeders;

use App\Models\GameType;
use Illuminate\Database\Seeder;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GameType::query()->firstOrCreate([
            'id' => 1,
            'title' => 'Intervalni narek',
            'description' => 'Vadi intervalni narek',
        ]);

        GameType::query()->firstOrCreate([
            'id' => 2,
            'title' => 'Ritmični narek',
            'description' => 'Vadi ritmični narek',
        ]);

        GameType::query()->firstOrCreate([
            'id' => 3,
            'title' => 'Harmonični narek',
            'description' => 'Vadi harmonični narek',
        ]);
    }
}
