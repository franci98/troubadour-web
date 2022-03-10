<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 */
class RhythmFeatureOccurrence extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_signature_id',
        'rhythm_feature_id',
        'difficulty_id',
        'probability'
    ];
}
