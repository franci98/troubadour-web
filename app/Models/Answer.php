<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property User user
 * @property Exercise exercise
 * @property int solving_time
 * @property int number_of_attempts
 * @property int deletions
 * @property int level
 * @property int sound_replays
 * @property double score
 */
class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'user_id',
        'solving_time',
        'number_of_attempts',
        'deletions',
        'level',
        'sound_replays',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function isLastAnswer(): bool
    {
        return $this->exercise->game->exercises()->count() == $this->exercise->game->answers()->where('user_id', $this->user_id)->count();
    }
}
