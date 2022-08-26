<?php

namespace App\Models;

use App\Utils\IntervalExerciseGenerator;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection value
 */
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

    public function notesCollection(): Collection
    {
        return collect($this->value)->map(fn($item) => ['type' => 'n', 'value' => 4]);
    }
}
