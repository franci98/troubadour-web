<?php

namespace App\Utils\BadgeChecker;

use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;

class FinishedGames implements BadgeCheckInterface
{
    public static function check(User $user, array $options = []): bool
    {
        if (
            isset($options['game_type_id']) &&
            isset($options['difficulty_id']) &&
            isset($options['count'])
        ) {
            $relevantGames = Game::query()
                ->where('game_type_id', $options['game_type_id'])
                ->where('difficulty_id', $options['difficulty_id'])
                ->get();

            $gameUser = GameUser::query()
                ->where('user_id', $user->id)
                ->where('is_finished', true)
                ->whereIn('game_id', $relevantGames->pluck('id'))
                ->get();
            return $gameUser->count() >= $options['count'];
        }
        return false;
    }
}
