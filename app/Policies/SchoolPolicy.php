<?php

namespace App\Policies;

use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, School $school)
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, School $school)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, School $school)
    {
        return $user->isSuperAdmin() && $school->users()->doesntExist();
    }
}
