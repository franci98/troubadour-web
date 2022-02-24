<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return true;
    }
}
