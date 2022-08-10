<?php

namespace App\Models;

use App\Utils\HarmonyExerciseGenerator;
use App\Utils\IntervalExerciseGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarmonyExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'value',
    ];

    protected $casts = [
        'value' => 'array'
    ];

    public static function generate(Exercise $exercise): HarmonyExercise
    {
        $generator = new HarmonyExerciseGenerator($exercise);
        $harmonyExercise = $generator->generateExercise();
        return $harmonyExercise;
    }
}
