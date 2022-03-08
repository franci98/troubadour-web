<?php

namespace App\Http\Resources;

use App\Models\GameType;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
        ];

        if ($this->game->gameType->id == GameType::INTERVALS)
            $resource['value'] = $this->intervalExercise->value;

        return $resource;
    }
}
