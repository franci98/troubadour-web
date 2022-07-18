<?php

namespace App\Models;

use App\Utils\IntervalExerciseGenerator;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntervalExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'value',
    ];

    protected $casts = [
        'value' => 'array'
    ];

    public static function generate(Exercise $exercise): IntervalExercise
    {
        $generator = new IntervalExerciseGenerator($exercise);
        $intervalExercise = $generator->generateExercise();
        return $intervalExercise;
    }
}
