<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{

    private $data = [
            [
                'id' => 1,
                'value' => 1,
                'title' => NULL,
                'min_rating' => 0,
                'max_rating' => 249,
            ],
            [
                'id' => 2,
                'value' => 2,
                'title' => NULL,
                'min_rating' => 250,
                'max_rating' => 499,
            ],
            [
                'id' => 3,
                'value' => 3,
                'title' => NULL,
                'min_rating' => 500,
                'max_rating' => 749,
            ],
            [
                'id' => 4,
                'value' => 4,
                'title' => NULL,
                'min_rating' => 750,
                'max_rating' => 999,
            ],
            [
                'id' => 5,
                'value' => 5,
                'title' => 'Recital za Glasbeno Mladino v Cankarjevem domu',
                'min_rating' => 1000,
                'max_rating' => 1249,
            ],
            [
                'id' => 6,
                'value' => 6,
                'title' => NULL,
                'min_rating' => 1250,
                'max_rating' => 1749,
            ],
            [
                'id' => 7,
                'value' => 7,
                'title' => NULL,
                'min_rating' => 1750,
                'max_rating' => 2249,
            ],
            [
                'id' => 8,
                'value' => 8,
                'title' => NULL,
                'min_rating' => 2250,
                'max_rating' => 2749,
            ],
            [
                'id' => 9,
                'value' => 9,
                'title' => NULL,
                'min_rating' => 2750,
                'max_rating' => 3249,
            ],
            [
                'id' => 10,
                'value' => 10,
                'title' => 'Nastop s Komornim godalnim orkestrom Slovenske Filharmonije',
                'min_rating' => 3250,
                'max_rating' => 3749,
            ],
            [
                'id' => 11,
                'value' => 11,
                'title' => NULL,
                'min_rating' => 3750,
                'max_rating' => 4749,
            ],
            [
                'id' => 12,
                'value' => 12,
                'title' => NULL,
                'min_rating' => 4750,
                'max_rating' => 5749,
            ],
            [
                'id' => 13,
                'value' => 13,
                'title' => NULL,
                'min_rating' => 5750,
                'max_rating' => 6749,
            ],
            [
                'id' => 14,
                'value' => 14,
                'title' => NULL,
                'min_rating' => 6750,
                'max_rating' => 7749,
            ],
            [
                'id' => 15,
                'value' => 15,
                'title' => 'Snemanje v studiih RTV Slovenija',
                'min_rating' => 7750,
                'max_rating' => 8749,
            ],
            [
                'id' => 16,
                'value' => 16,
                'title' => NULL,
                'min_rating' => 8750,
                'max_rating' => 10749,
            ],
            [
                'id' => 17,
                'value' => 17,
                'title' => NULL,
                'min_rating' => 10750,
                'max_rating' => 12749,
            ],
            [
                'id' => 18,
                'value' => 18,
                'title' => NULL,
                'min_rating' => 12750,
                'max_rating' => 14749,
            ],
            [
                'id' => 19,
                'value' => 19,
                'title' => NULL,
                'min_rating' => 14750,
                'max_rating' => 16749,
            ],
            [
                'id' => 20,
                'value' => 20,
                'title' => 'Solo nastop z Orkestrom Slovenske Filharmonije',
                'min_rating' => 16750,
                'max_rating' => 18749,
            ],
            [
                'id' => 21,
                'value' => 21,
                'title' => NULL,
                'min_rating' => 18750,
                'max_rating' => 21749,
            ],
            [
                'id' => 22,
                'value' => 22,
                'title' => NULL,
                'min_rating' => 21750,
                'max_rating' => 24749,
            ],
            [
                'id' => 23,
                'value' => 23,
                'title' => NULL,
                'min_rating' => 24750,
                'max_rating' => 27749,
            ],
            [
                'id' => 24,
                'value' => 24,
                'title' => NULL,
                'min_rating' => 27750,
                'max_rating' => 30749,
            ],
            [
                'id' => 25,
                'value' => 25,
                'title' => 'Sodelovanje v Evropskem mladinskem orkestru',
                'min_rating' => 30750,
                'max_rating' => 33749,
            ],
            [
                'id' => 26,
                'value' => 26,
                'title' => NULL,
                'min_rating' => 33750,
                'max_rating' => 36749,
            ],
            [
                'id' => 27,
                'value' => 27,
                'title' => NULL,
                'min_rating' => 36750,
                'max_rating' => 39749,
            ],
            [
                'id' => 28,
                'value' => 28,
                'title' => NULL,
                'min_rating' => 39750,
                'max_rating' => 42749,
            ],
            [
                'id' => 29,
                'value' => 29,
                'title' => NULL,
                'min_rating' => 42750,
                'max_rating' => 45749,
            ],
            [
                'id' => 30,
                'value' => 30,
                'title' => 'Solo nastop v koncertni dvorani Concertgebow v Amsterdamu',
                'min_rating' => 45750,
                'max_rating' => 48749,
            ],
            [
                'id' => 31,
                'value' => 31,
                'title' => NULL,
                'min_rating' => 48750,
                'max_rating' => 52749,
            ],
            [
                'id' => 32,
                'value' => 32,
                'title' => NULL,
                'min_rating' => 52750,
                'max_rating' => 56749,
            ],
            [
                'id' => 33,
                'value' => 33,
                'title' => NULL,
                'min_rating' => 56750,
                'max_rating' => 60749,
            ],
            [
                'id' => 34,
                'value' => 34,
                'title' => NULL,
                'min_rating' => 60750,
                'max_rating' => 64749,
            ],
            [
                'id' => 35,
                'value' => 35,
                'title' => 'Igranje na evropski turneji s koncertno agencijo European Artistic Services',
                'min_rating' => 64750,
                'max_rating' => 68749,
            ],
            [
                'id' => 36,
                'value' => 36,
                'title' => NULL,
                'min_rating' => 68750,
                'max_rating' => 72749,
            ],
            [
                'id' => 37,
                'value' => 37,
                'title' => NULL,
                'min_rating' => 72750,
                'max_rating' => 76749,
            ],
            [
                'id' => 38,
                'value' => 38,
                'title' => NULL,
                'min_rating' => 76750,
                'max_rating' => 80749,
            ],
            [
                'id' => 39,
                'value' => 39,
                'title' => NULL,
                'min_rating' => 80750,
                'max_rating' => 84749,
            ],
            [
                'id' => 40,
                'value' => 40,
                'title' => 'Finale Evropskega tekmovanja mladih glasbenikov',
                'min_rating' => 84750,
                'max_rating' => 88749,
            ],
            [
                'id' => 41,
                'value' => 41,
                'title' => NULL,
                'min_rating' => 88750,
                'max_rating' => 93749,
            ],
            [
                'id' => 42,
                'value' => 42,
                'title' => NULL,
                'min_rating' => 93750,
                'max_rating' => 98749,
            ],
            [
                'id' => 43,
                'value' => 43,
                'title' => NULL,
                'min_rating' => 98750,
                'max_rating' => 103749,
            ],
            [
                'id' => 44,
                'value' => 44,
                'title' => NULL,
                'min_rating' => 103750,
                'max_rating' => 108749,
            ],
            [
                'id' => 45,
                'value' => 45,
                'title' => 'Zmaga na Evropskem tekmovanju mladih glasbenikov',
                'min_rating' => 108750,
                'max_rating' => 113749,
            ]
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Level::query()->exists())
            return;

        foreach ($this->data as $item) {
            Level::query()->create($item);
        }
    }
}
