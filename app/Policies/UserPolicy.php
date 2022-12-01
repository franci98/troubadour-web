<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isSuperAdmin() || $user->isSchoolAdmin();
    }

    public function view(User $user, User $model)
    {
        return $user->isSuperAdmin() || ($user->isSchoolAdminOf($model->school));
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isSchoolAdmin();
    }

    public function update(User $user, User $model)
    {
        return $user->isSuperAdmin() || ($user->isSchoolAdminOf($model->school));
    }

    public function delete(User $user, User $model)
    {
        return ($user->isSuperAdmin() && !$model->isSuperAdmin()) || ($user->isSchoolAdminOf($model->school));
    }

}
