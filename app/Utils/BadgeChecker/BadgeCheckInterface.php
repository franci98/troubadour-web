<?php

namespace App\Utils\BadgeChecker;

use App\Models\User;

interface BadgeCheckInterface
{
    public function check(User $user, array $options = []): bool;
}
