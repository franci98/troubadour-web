<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property boolean is_crossbar
 */
class RhythmFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'is_crossbar',
    ];

}
