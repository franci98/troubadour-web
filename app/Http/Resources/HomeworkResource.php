<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeworkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "games_required" => $this->games_required,
            "available_at" => $this->available_at,
            "finished_at" => $this->finished_at,
            "users" => $this->users->pluck('id'),
            "game_type" => $this->game_type,
            "challenge_type" => $this->challenge_type,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "games" => GameResource::collection($this->whenLoaded('games'))
        ];
    }
}
