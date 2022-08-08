<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int id
 * @property User user
 * @property Game game
 * @property int points
 * @property bool is_finished
 * @property Carbon created_at
 */
class GameUser extends Model
{
    use HasFactory;

    protected $table = 'game_user';

    protected $fillable = [
        'user_id',
        'game_id',
        'points',
        'is_finished',
    ];

    public function addPoints(int $points)
    {
        $this->points += $points;
        $this->is_finished = true;
        $this->save();
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id', 'user_id')->whereIn('exercise_id', $this->game->exercises->pluck('id'));
    }

    public function allAnswersCorrect(): bool
    {
        return $this->answers()->where('score', '>', 0)->count() == $this->game->exercises()->count();
    }
}
