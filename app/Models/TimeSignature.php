<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property Collection rhythmFeatureOccurrences
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

    public function rhythmFeatureOccurrences()
    {
        return $this->hasMany(RhythmFeatureOccurrence::class);
    }
}
