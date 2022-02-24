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
            'title' => 'Intervalni narek',
            'description' => 'Vadi intervalni narek',
        ]);

        GameType::query()->firstOrCreate([
            'title' => 'Ritmični narek',
            'description' => 'Vadi ritmični narek',
        ]);

        GameType::query()->firstOrCreate([
            'title' => 'Harmonični narek',
            'description' => 'Vadi harmonični narek',
        ]);
    }
}
