<?php

namespace App\Http\Resources;

use App\Models\Exercise;
use App\Models\GameType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="Game",
 *      description="Game details.",
 *      type="object",
 * )
 */
class GameResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->resource->id,
            'created_at' => $this->created_at,
            'game_type' => GameTypeResource::make($this->gameType),
            'exercises' => ExerciseResource::collection($this->exercises)
        ];
        $data['allowed_attempts'] = 12;
        $data['seconds_per_exercise'] = 600;

        if ($data['game_type']['id'] == GameType::RHYTHM) {
            $data['beats_per_minute'] = 120;
            $data['beats_count'] = 2;
        }

        return $data;
    }
}
