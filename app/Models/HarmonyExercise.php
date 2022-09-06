<?php

namespace App\Models;

use App\Utils\HarmonyExerciseGenerator;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection value
 */
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

    public function notesCollection(): array
    {
        return [['type' => 'n', 'value' => 2]];
    }
}
