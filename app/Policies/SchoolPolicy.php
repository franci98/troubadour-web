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
        return $user->isSuperAdmin() || ($user->isSchoolAdminOf($school));
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, School $school)
    {
        return $user->isSuperAdmin() && $school->id !== School::NO_SCHOOL_ID;
    }

    public function delete(User $user, School $school)
    {
        return $user->isSuperAdmin() && $school->id !== School::NO_SCHOOL_ID;
    }
}
