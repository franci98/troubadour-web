<?php

namespace Database\Seeders;

use App\Models\Difficulty;
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
            'value' => 1,
            'description' => 'Zelo lahko'
        ];
        $difficulties[] = [
            'title' => '12',
            'value' => 2,
            'description' => 'Zelo lahko a malo izziv'
        ];
        $difficulties[] = [
            'title' => '44',
            'value' => 3,
            'description' => 'Zelo težko'
        ];

        foreach ($difficulties as $i => $difficulty) {
            Difficulty::query()->firstOrCreate($difficulty);
        }
    }
}
