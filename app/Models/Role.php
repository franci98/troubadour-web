<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const SUPER_ADMIN = 1;
    const SCHOOL_ADMIN = 2;
    const TEACHER = 3;

    const ROLES = [
        self::SUPER_ADMIN => 'Super Admin',
        self::SCHOOL_ADMIN => 'School Admin',
        self::TEACHER => 'Teacher',
    ];
}
