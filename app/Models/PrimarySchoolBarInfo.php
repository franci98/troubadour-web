<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimarySchoolBarInfo extends Model
{
    use HasFactory;

    protected $casts = [
        'bar_info' => 'array'
    ];
}
