<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Difficulty;
use App\Models\GameType;
use App\Utils\BadgeChecker\AllAnswersCorrectBadge;
use App\Utils\BadgeChecker\FinishedGames;
use Illuminate\Database\Seeder;

class BadgesTableSeeder extends Seeder
{

    private $data = [
        [
            'id' => 1,
            'title' => 'Igra brez napake',
            'description' => 'Pravilno moraš odgovoriti na vsa vprašanja v igri.',
            'implemented_in' => AllAnswersCorrectBadge::class,
        ],
        [
            'id' => 2,
            'title' => 'Znam uporabljati ritmične vaje',
            'description' => 'Pravilno moraš rešiti 10 ritmičnih vaj iz prvega nivoja prvega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 1,
                'count' => 10,
            ],
        ],
        [
            'id' => 3,
            'title' => 'Igra s 50% točnostjo',
            'description' => 'Pravilno moraš rešiti 15 ritmičnih vaj iz drugega nivoja prvega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 2,
                'count' => 15,
            ],
        ],
        [
            'id' => 4,
            'title' => 'Zdaj pa že znam',
            'description' => 'Pravilno moraš rešiti 20 ritmičnih vaj iz tretjega nivoja prvega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 3,
                'count' => 20,
            ],
        ],
        [
            'id' => 5,
            'title' => 'Napredovanje v drugi letnik',
            'description' => 'Pravilno moraš rešiti 20 ritmičnih vaj iz četrtega nivoja prvega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 4,
                'count' => 20,
            ],
        ],
        [
            'id' => 6,
            'title' => 'Dober začetek',
            'description' => 'Pravilno moraš rešiti 20 ritmičnih vaj iz prvega nivoja drugega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 5,
                'count' => 20,
            ],
        ],
        [
            'id' => 7,
            'title' => 'Nič me ne more ustaviti',
            'description' => 'Pravilno moraš rešiti 25 ritmičnih vaj iz drugega nivoja drugega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 6,
                'count' => 25,
            ],
        ],
        [
            'id' => 8,
            'title' => 'Triole so mačji kašelj',
            'description' => 'Pravilno moraš rešiti 25 ritmičnih vaj iz tretjega nivoja drugega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 7,
                'count' => 25,
            ],
        ],
        [
            'id' => 9,
            'title' => 'Napredovanje v tretji letnik',
            'description' => 'Pravilno moraš rešiti 30 ritmičnih vaj četrtega nivoja drugega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 8,
                'count' => 30,
            ],
        ],
        [
            'id' => 10,
            'title' => 'Vajenec ritmičnega čarovnika',
            'description' => 'Pravilno moraš rešiti 30 ritmičnih vaj prvega nivoja tretjega letnika',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 9,
                'count' => 30,
            ],
        ],
        [
            'id' => 11,
            'title' => 'Na poti do slave',
            'description' => 'Pravilno moraš rešiti 30 ritmičnih vaj drugega nivoja tretjega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 10,
                'count' => 30,
            ],
        ],
        [
            'id' => 12,
            'title' => 'Sanjam šestnajstinke',
            'description' => 'Pravilno moraš rešiti 35 ritmičnih vaj tretjega nivoja tretjega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 11,
                'count' => 35,
            ],
        ],
        [
            'id' => 13,
            'title' => 'Igra končana v 25 minutah',
            'description' => 'Igro moraš končati v času izpod 25 minut.',
            'implemented_in' => FinishedGames::class,
        ],
        [
            'id' => 14,
            'title' => 'Ritmični čarovnik',
            'description' => 'Pravilno moraš rešiti 40 ritmičnih vaj prvega nivoja četrtega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 14,
                'count' => 40,
            ],
        ],
        [
            'id' => 15,
            'title' => 'Kralj ritma',
            'description' => 'Pravilno moraš rešiti 40 ritmičnih vaj drugega nivoja četrtega letnika',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 15,
                'count' => 40,
            ],
        ],
        [
            'id' => 16,
            'title' => 'Profesorjev asistent',
            'description' => 'Pravilno moraš rešiti 40 ritmičnih vaj tretjega nivoja četrtega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 16,
                'count' => 40,
            ],
        ],
        [
            'id' => 17,
            'title' => 'Ritmični genij',
            'description' => 'Pravilno moraš rešiti 40 ritmičnih vaj četrtega nivoja četrtega letnika.',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 17,
                'count' => 40,
            ],
        ],
        [
            'id' => 18,
            'title' => 'Dokončana igra 3 dni zapored',
            'description' => '3 dni zapored moraš dokončati igro.',
        ],
        [
            'id' => 19,
            'title' => 'Uspešni prvi koraki',
            'description' => 'Pravilno moraš rešiti 20 ritmičnih vaj iz drugega nivoja prvega letnika',
            'implemented_in' => FinishedGames::class,
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 2,
                'count' => 20,
            ],
        ],
        [
            'id' => 20,
            'title' => 'Napredovanje v četrti letnik',
            'description' => 'Pravilno moraš rešiti 35 ritmičnih vaj četrtega nivoja tretjega letnika.',
            'options' => [
                'game_type_id' => GameType::RHYTHM,
                'difficulty_id' => 12,
                'count' => 35,
            ],
        ],
        [
            'id' => 21,
            'title' => 'Dokončana igra 7 dni zapored',
            'description' => '7 dni zapored moraš dokončati igro.',
        ],
        [
            'id' => 22,
            'title' => 'Dokončana igra z vsemi različnimi inštrumenti',
            'description' => 'Dokončati moraš vsaj 1 igro z vsakim od inštrumentov.',
        ],
        [
            'id' => 23,
            'title' => 'Prijava 3 dni zapored',
            'description' => '3 dni zapored se moraš prijaviti v aplikacijo.',
        ],
        [
            'id' => 24,
            'title' => 'Prijava 7 dni zapored',
            'description' => '7 dni zapored moraš dokončati igro.',
        ],
        [
            'id' => 25,
            'title' => 'Zmaga v večigralski igri',
            'description' => 'Zmagati moraš v igri večigralskega načina.',
        ]
    ];



    public function run()
    {
        if (Badge::all()->count() > 0)
            return;
        foreach ($this->data as $item) {
            \App\Models\Badge::query()->firstOrCreate($item);
        }
    }
}
