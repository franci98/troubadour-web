<?php

namespace App\Http\Resources;

use App\Models\GameType;
use App\Models\RhythmBar;
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
        elseif ($this->game->gameType->id == GameType::RHYTHM)
            $resource['value'] = RhythmBarResource::collection($this->rhythmExercise->bars);


        return $resource;
    }
}
