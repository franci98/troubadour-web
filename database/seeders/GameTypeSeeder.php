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
            'mobile_only' => false,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 2,
            'title' => 'Ritmični narek',
            'description' => 'poslušaj in zapiši',
            'mobile_only' => false,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 3,
            'title' => 'Harmonični narek',
            'description' => 'Vadi harmonični narek',
            'mobile_only' => false,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 4,
            'title' => 'Ritmični kviz',
            'description' => 'poslušaj in izberi',
            'mobile_only' => false,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 5,
            'title' => 'Igraj ritem',
            'description' => 'preberi in zaigraj',
            'mobile_only' => false,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 6,
            'title' => 'Zapoj interval',
            'description' => 'Zapoj interval',
            'mobile_only' => true,
        ]);

        GameType::query()->firstOrCreate([
            'id' => 8,
            'title' => 'Zapoj harmonijo',
            'description' => 'Zapoj harmonijo',
            'mobile_only' => true,
        ]);
    }
}
