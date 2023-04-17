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
 * @property RhythmQuizExercise|null rhythmQuizExercise
 * @property PrimarySchoolRhythmExercise|null primarySchoolRhythmExercise
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

    public function primarySchoolRhythmExercise()
    {
        return $this->hasOne(PrimarySchoolRhythmExercise::class);
    }

    public function rhythmQuizExercise()
    {
        return $this->hasOne(RhythmQuizExercise::class);
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
            $soundController->generateExerciseSound($this->rhythmExercise()->first()->id, $baseFilePath.$this->id, $info);
        } else if ($this->game->gameType->id == GameType::INTERVALS) {
            $info = (object) [
                'metronome' => false,
            ];
            $soundController->generateIntervalExerciseSound($this->intervalExercise->id, $baseFilePath.$this->id, $info);
        } else if ($this->game->gameType->id == GameType::HARMONIC) {
            $info = (object) [
                'metronome' => false,
            ];
            $soundController->generateHarmonyExerciseSound($this->harmonyExercise->id, $baseFilePath.$this->id, $info);
        } else if ($this->game->gameType->id == GameType::PRIMARY_SCHOOL_RHYTHM) {
            $info = (object) [
                'metronome' => true,
            ];
            $soundController->generatePrimarySchoolRhythmExerciseSound($this->primarySchoolRhythmExercise->id, $baseFilePath.$this->id, $info);
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

    /**
     * Get MIDI instrument code
     *
     * This method returns an integer representing a specific MIDI instrument. In this way, every exercise,
     * can have its own instrument sound when generating a mp3 file. All MIDI instruments found at https://fmslogo.sourceforge.io/manual/midi-instrument.html
     *
     * @return int
     */
    public function getMidiInstrumentCode(): int
    {
        return match ($this->game->gameType->id) {
            GameType::RHYTHM => 5,
            default => 1,
        };
    }

    public function delete()
    {
        optional($this->rhythmExercise)->delete();
        optional($this->intervalExercise)->delete();
        $this->answers()->delete();

        return parent::delete();
    }

    public function recreate()
    {
        if ($this->game->gameType->id == GameType::RHYTHM) {
            $this->rhythmExercise->delete();
        } else if ($this->game->gameType->id == GameType::INTERVALS) {
            $this->intervalExercise->delete();
        }
        $this->deleteMp3File();
        $this->game->gameType->regenerateExercise($this);
    }
}
