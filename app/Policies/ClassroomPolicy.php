<?php

namespace App\Policies;

use App\Models\CLassroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, CLassroom $Classroom)
    {
        return $Classroom->user()->is($user); 
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, CLassroom $Classroom)
    {
        return $Classroom->user()->is($user);
    }

    public function delete(User $user, CLassroom $Classroom)
    {
        //
    }
    
}
