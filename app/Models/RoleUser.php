<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    const STATUS_UNCONFIRMED = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DENIED = 3;
}
