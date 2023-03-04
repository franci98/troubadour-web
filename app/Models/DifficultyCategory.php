<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property int sequence
 * @property bool is_active
 * @property GameType gameType
 * @property Difficulty[] difficulties
 */
class DifficultyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sequence',
        'is_active',
        'game_type_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function gameType()
    {
        return $this->belongsTo(GameType::class);
    }

    public function difficulties()
    {
        return $this->hasMany(Difficulty::class);
    }
}
