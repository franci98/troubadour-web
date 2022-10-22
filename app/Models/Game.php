<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'game_user');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Exercise::class);
    }

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function createExercises()
    {
        foreach (range(1, self::EXERCISES_PER_GAME) as $i) {
            $this->gameType->generateExercise($this);
        }
    }

    public function assign(User $user)
    {
        GameUser::query()->create([
            'game_id' => $this->id,
            'user_id' => $user->id,
        ]);
    }

    public function finishGameFor(User $user)
    {
        $points = $this->answers()->where('user_id', $user->id)->sum('score');
        GameUser::query()->where('user_id', $user->id)->firstWhere('game_id', $this->id)->addPoints($points);
    }

    public function delete()
    {
        GameUser::query()->where('game_id', $this->id)->delete();
        foreach ($this->exercises as $item) {
            $item->delete();
        }
        return parent::delete();
    }
}
