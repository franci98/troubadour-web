<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 */
class RhythmSymbolOccurrence extends Model
{
    use HasFactory;

    protected $fillable = [
        'probability'
    ];
}
