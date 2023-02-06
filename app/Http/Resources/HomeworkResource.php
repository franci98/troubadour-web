<?php

namespace App\Http\Resources;

use App\Models\Game;
use App\Models\GameUser;
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
        $data = [
            "id" => $this->id,
            "name" => $this->name,
            "games_required" => $this->games_required,
            "available_at" => $this->available_at->format('Y-m-d H:i:s'),
            "finished_at" => $this->finished_at->format('Y-m-d H:i:s'),
            "users" => $this->users->pluck('id'),
            "game_type" => $this->gameType->title,
            "difficulty" => DifficultyResource::make($this->difficulty),
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
        ];

        $data['games_finished'] = $this->countGamesOf(auth()->user());
        $data['next_game'] = Game::query()
            ->where('homework_id', $this->id)
            ->whereDoesntHave('users', fn($query) => $query->where('users.id', auth()->id()))
            ->first();

        return $data;
    }
}
