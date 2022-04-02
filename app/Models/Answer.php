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
 */
class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'user_id',
        'solving_time',
        'number_of_attempts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
