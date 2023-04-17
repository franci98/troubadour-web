<?php

namespace App\Models;

use App\Utils\PrimarySchoolRhythmExerciseGenerator;
use App\Utils\RhythmExerciseGenerator;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrimarySchoolRhythmExercise extends Model
{
    use HasFactory;
    protected $fillable = [
        'primary_school_bar_info_id',
        'exercise_id',
        'BPM',
        'rhythm_level',
        'mp3_generated',
    ];

    public static function generate(Exercise $exercise, int $gameType): PrimarySchoolRhythmExercise
    {
        $rhythmExercise = null;
        while ($rhythmExercise == null) {
            try {
                $rhythmExercise = PrimarySchoolRhythmExerciseGenerator::generateForLevel($exercise->game->difficulty->title, $exercise);
            } catch (Exception $e) {
                dd($e->getMessage());
                Log::error($e->getMessage());
            }
        }
        return $rhythmExercise;
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function primarySchoolBarInfo()
    {
        return $this->belongsTo(PrimarySchoolBarInfo::class);
    }

    public function bars()
    {
        return $this->belongsToMany(PrimarySchoolRhythmBar::class, 'primary_school_rhythm_exercise_bars')->withPivot(['seq'])->orderBy('seq');
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
        DB::table('primary_school_rhythm_exercise_bars')->where('primary_school_rhythm_exercise_id', $this->id)->delete();
        return parent::delete();
    }
}
