<?php

namespace App\Models;

use App\Utils\RhythmExerciseGenerator;
use App\Utils\RhythmQuizExerciseGenerator;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @property int id
 * @property Exercise exercise
 * @property RhythmBar[] bars
 * @property BarInfo barInfo
 * @property int BPM
 * @property int rhythm_level
 * @property bool mp3_generated
 */
class RhythmQuizExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'bar_info_id',
        'exercise_id',
        'BPM',
        'rhythm_level',
        'mp3_generated',
    ];

    protected $casts = [
        'mp3_generated' => 'boolean',
    ];

    public static function generate(Exercise $exercise, int $gameType): RhythmQuizExercise
    {
        $generator = new RhythmQuizExerciseGenerator($exercise);
        $rhythmQuizExercise = null;
        while ($rhythmQuizExercise == null) {
            try {
                $rhythmQuizExercise = $generator->generateExercise();
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
        return $rhythmQuizExercise;
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function barInfo()
    {
        return $this->belongsTo(BarInfo::class);
    }

    public function bars()
    {
        return $this->belongsToMany(RhythmBar::class, 'rhythm_quiz_exercise_bars')->withPivot(['seq'])->orderBy('seq');
    }

    public function notesCollection(): array
    {
        $notes = json_decode($this->bars[0]->content);
        for($i = 1; $i < count($this->bars); $i++){
            $notes = array_merge($notes, json_decode($this->bars[$i]->content));
        }

        return $notes;
    }

    public function delete()
    {
        DB::table('rhythm_quiz_exercise_bars')->where('rhythm_quiz_exercise_id', $this->id)->delete();
        return parent::delete();
    }
}
