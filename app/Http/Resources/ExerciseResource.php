<?php

namespace App\Http\Resources;

use App\Models\Game;
use App\Models\GameType;
use App\Models\TimeSignature;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'mp3_url' => config('app.url') . "/audio/$this->id.mp3",
        ];

        if ($this->game->gameType->id == GameType::INTERVALS)
            $resource['value'] = $this->intervalExercise->value;
        elseif ($this->game->gameType->id == GameType::RHYTHM) {
            $resource['value'] = RhythmBarResource::collection($this->rhythmExercise->bars);
            $resource['time_signature'] = $this->rhythmExercise->barInfo;
        } elseif ($this->game->gameType->id == GameType::RHYTHM_GUESS) {
            $resource['value'] = RhythmBarResource::collection($this->rhythmExercise->bars);
            $resource['time_signature'] = $this->rhythmExercise->barInfo;
        } elseif ($this->game->gameType->id == GameType::RHYTHM_TAP) {
            $resource['value'] = RhythmBarResource::collection($this->rhythmExercise->bars);
            $resource['time_signature'] = $this->rhythmExercise->barInfo;
        } elseif ($this->game->gameType->id == GameType::HARMONIC) {
            $resource['value'] = $this->harmonyExercise->value;
        }

        return $resource;
    }
}
