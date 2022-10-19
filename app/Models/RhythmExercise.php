<?php

namespace App\Models;

use App\Utils\RhythmExerciseGenerator;
use App\Models\GameType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

/**
 * @property int id
 * @property Collection bars
 * @property Exercise exercise
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

    public static function generate(Exercise $exercise, int $gameType): RhythmExercise
    {
        if ($gameType == 4) {
            return RhythmExerciseGenerator::generateForGuessLevel($exercise->game->difficulty->title, $exercise);
        } elseif ($gameType == 5) {
            return RhythmExerciseGenerator::generateForTapLevel($exercise->game->difficulty->title, $exercise);
        }
        return RhythmExerciseGenerator::generateForLevel($exercise->game->difficulty->title, $exercise);
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

    public function delete()
    {
        DB::table('rhythm_exercise_bars')->where('rhythm_exercise_id', $this->id)->delete();
        return parent::delete();
    }
}
