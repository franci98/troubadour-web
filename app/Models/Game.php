<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property Difficulty difficulty
 * @property GameType gameType
 * @property Collection exercises
 * @property Carbon created_at
 */
class Game extends Model
{
    use HasFactory;
    const EXERCISES_PER_GAME = 4;

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

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function createExercises()
    {
        foreach (range(1, self::EXERCISES_PER_GAME) as $i) {
            $this->gameType->generateExercise($this);
        }
    }
}
