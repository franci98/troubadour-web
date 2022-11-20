<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::query()->firstOrCreate([
            'id' => 1,
            'name' => 'Brez Šole'
        ]);
        School::query()->firstOrCreate([
            'id' => 2,
            'name' => 'Konservatorij za glasbo in balet Ljubljana'
        ]);
    }
}
