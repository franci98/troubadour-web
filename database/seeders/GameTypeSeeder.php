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
            'description' => 'poslušaj in zapiši',
        ]);

        GameType::query()->firstOrCreate([
            'id' => 3,
            'title' => 'Harmonični narek',
            'description' => 'Vadi harmonični narek',
        ]);

        GameType::query()->firstOrCreate([
            'id' => 4,
            'title' => 'Ritmični kviz',
            'description' => 'poslušaj in izberi',
        ]);

        GameType::query()->firstOrCreate([
            'id' => 5,
            'title' => 'Igraj ritem',
            'description' => 'preberi in zaigraj',
        ]);
    }
}
