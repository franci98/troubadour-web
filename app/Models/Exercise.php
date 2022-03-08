<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property IntervalExercise intervalExercise
 * @property Game game
 * @property Carbon created_at
 */
class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'game_type_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function intervalExercise()
    {
        return $this->hasOne(IntervalExercise::class);
    }
}
