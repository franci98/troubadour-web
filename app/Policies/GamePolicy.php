<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Game $game)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }
}
