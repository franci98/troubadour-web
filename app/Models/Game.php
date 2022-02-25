<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property Difficulty difficulty
 * @property GameType gameType
 * @property Carbon created_at
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        "difficulty_id",
        "game_type_id",
    ];

    public function gameType()
    {
        return $this->belongsTo(GameType::class);
    }

    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function createExercises()
    {
        // TODO
    }
}
