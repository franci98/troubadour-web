<?php

namespace App\Models;

use App\Utils\RhythmExerciseGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property Collection bars
 */
class RhythmExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'bar_info_id',
        'exercise_id',
        'BPM',
        'rhythm_level',
        'mp3_generated',
    ];

    public static function generate(Exercise $exercise): RhythmExercise
    {
        return RhythmExerciseGenerator::generateForLevel($exercise->game->difficulty->title, $exercise);
    }

    public function bars()
    {
        return $this->belongsToMany(RhythmBar::class, 'rhythm_exercise_bars')->withPivot(['seq'])->orderBy('seq');
    }

}
