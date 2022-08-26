<?php

namespace App\Console\Commands;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldSoundFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sound:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes sound files of old games.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $games = Game::query()
            ->whereDate('created_at', '<', now()->subWeek())
            ->whereDate('created_at', '>', now()->subWeeks(3))
            ->get();
        foreach ($games as $game) {
            foreach ($game->exercises as $exercise) {
                $exercise->deleteMp3File();
            }
        }
        return 0;
    }
}
