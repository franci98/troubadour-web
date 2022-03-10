<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 */
class TimeSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'value',
        'probability',
    ];

    protected $casts = [
        'value' => 'array'
    ];
}
