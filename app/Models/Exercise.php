<?php

namespace App\Models;

use App\Utils\Midi\MidiNotes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * @property int id
 * @property IntervalExercise intervalExercise
 * @property RhythmExercise rhythmExercise
 * @property Game game
 * @property Carbon created_at
 */
class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'game_type_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function intervalExercise()
    {
        return $this->hasOne(IntervalExercise::class);
    }

    public function rhythmExercise()
    {
        return $this->hasOne(RhythmExercise::class);
    }

    public function harmonyExercise()
    {
        return $this->hasOne(HarmonyExercise::class);
    }

    public function generateMp3File()
    {
        $soundController = new MidiNotes();
        $baseFilePath = public_path("audio/");
        if ($this->game->gameType->id == GameType::RHYTHM) {
            $info = (object) [
                'metronome' => true,
            ];
            $soundController->generateExerciseSound($this->rhythmExercise->id, $baseFilePath.$this->id, $info);
        } else if ($this->game->gameType->id == GameType::INTERVALS) {
            $info = (object) [
                'metronome' => false,
            ];
            $soundController->generateIntervalExerciseSound($this->intervalExercise->id, $baseFilePath.$this->id, $info);
        }
    }

    public function deleteMp3File()
    {
        $baseFilePath = public_path("audio/");
        File::delete($baseFilePath.$this->id.'.mp3');
        File::delete($baseFilePath.$this->id.'.mid');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
