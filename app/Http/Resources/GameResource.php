<?php

namespace App\Http\Resources;

use App\Models\Exercise;
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
        return [
            'created_at' => $this->created_at,
            'game_type' => GameTypeResource::make($this->gameType),
            'exercises' => ExerciseResource::collection($this->exercises)
        ];
    }
}
