<?php

namespace App\Utils\BadgeChecker;

use App\Models\GameUser;
use App\Models\User;

class AllAnswersCorrectBadge implements BadgeCheckInterface
{

    public function check(User $user, array $options = []): bool
    {
        $gameUser = GameUser::query()
            ->where('user_id', $user->id)
            ->latest()
            ->first();
        return $gameUser->allAnswersCorrect();
    }
}