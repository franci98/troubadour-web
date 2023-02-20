<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string title
 * @property string description
 */
class GameType extends Model
{
    use SoftDeletes;
    use HasFactory;
    const INTERVALS = 1;
    const RHYTHM = 2;
    const HARMONIC = 3;
    const RHYTHM_GUESS = 4;
    const RHYTHM_TAP = 5;

    protected $fillable = [
        'title',
        'description',
    ];

    public function generateExercise(Game $game)
    {
        $exercise = Exercise::query()->create([
            'game_id' => $game->id,
            'game_type_id' => $this->id,
        ]);
        if ($this->id == self::INTERVALS) {
            IntervalExercise::generate($exercise);
        } elseif ($this->id == self::RHYTHM) {
            RhythmExercise::generate($exercise, self::RHYTHM);
        } elseif ($this->id == self::RHYTHM_GUESS) {
            RhythmExercise::generate($exercise, self::RHYTHM_GUESS);
        } elseif ($this->id == self::RHYTHM_TAP) {
            RhythmExercise::generate($exercise, self::RHYTHM_TAP);
        } elseif ($this->id == self::HARMONIC) {
            HarmonyExercise::generate($exercise);
        }
        $exercise->generateMp3File();
    }

    public function regenerateExercise(Exercise $exercise)
    {
        if ($this->id == self::INTERVALS) {
            $exercise->intervalExercise = IntervalExercise::generate($exercise);
        } elseif ($this->id == self::RHYTHM) {
            $exercise->rhythmExercise = RhythmExercise::generate($exercise, self::RHYTHM);
        } elseif ($this->id == self::RHYTHM_GUESS) {
            RhythmExercise::generate($exercise, self::RHYTHM_GUESS);
        } elseif ($this->id == self::RHYTHM_TAP) {
            RhythmExercise::generate($exercise, self::RHYTHM_TAP);
        } elseif ($this->id == self::HARMONIC) {
            HarmonyExercise::generate($exercise);
        }
        $exercise->generateMp3File();
    }

    public function difficulties()
    {
        return $this->hasMany(Difficulty::class);
    }

}
