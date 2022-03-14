<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property RhythmSymbol rhythmSymbol
 * @property RhythmFeature rhythmFeature
 */
class RhythmSymbolOccurrence extends Model
{
    use HasFactory;

    protected $fillable = [
        'rhythm_symbol_id',
        'rhythm_feature_id',
        'probability'
    ];

    public function rhythmSymbol()
    {
        return $this->belongsTo(RhythmSymbol::class);
    }

    public function rhythmFeature()
    {
        return $this->belongsTo(RhythmFeature::class);
    }
}
