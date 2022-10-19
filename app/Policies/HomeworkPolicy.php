<?php

namespace App\Policies;

use App\Models\Homework;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeworkPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Homework $homework)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Homework $homework)
    {
        //
    }

    public function delete(User $user, Homework $homework)
    {
        return $user->isTeacherOf($homework->classroom) ;
    }
}
