<?php

namespace App\Models;

use App\Utils\InverseHarmonyExerciseGenerator;
use App\Utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * @property Collection value
 * @property Exercise exercise
 */
class InverseHarmonyExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'value',
    ];

    protected $casts = [
        'value' => 'array'
    ];

    public static function generate(Exercise $exercise): InverseHarmonyExercise
    {
        $generator = new InverseHarmonyExerciseGenerator($exercise);
        $harmonyExercise = $generator->generateExercise();
        return $harmonyExercise;
    }

    public function notesCollection(): array
    {
        if ($this->value['razlozen']) {
            return collect($this->value['keys'])->map(fn($item) => ['type' => 'n', 'value' => 4])->toArray();
        } else {
            return [['type' => 'n', 'value' => 2]];
        }
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
