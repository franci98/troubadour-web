<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isSuperAdmin() || $user->isSchoolAdmin() || $user->isTeacher();
    }

    public function view(User $user, Classroom $classroom)
    {
        return $user->isTeacherOf($classroom);
    }

    public function create(User $user)
    {
        return $user->isTeacher();
    }

    public function update(User $user, Classroom $classroom)
    {
        return $user->isTeacherOf($classroom);
    }

    public function delete(User $user, Classroom $Classroom)
    {
        //
    }

}
