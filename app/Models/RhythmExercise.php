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

    public function barInfo()
    {
        return $this->belongsTo(BarInfo::class);
    }

    public function bars()
    {
        return $this->belongsToMany(RhythmBar::class, 'rhythm_exercise_bars')->withPivot(['seq'])->orderBy('seq');
    }

    public function notesCollection(): array
    {
        $notes = json_decode($this->bars[0]->content);
        for($i = 1; $i < count($this->bars); $i++){
            $notes = array_merge($notes, json_decode($this->bars[$i]->content));
        }

        return $notes;
    }
}
