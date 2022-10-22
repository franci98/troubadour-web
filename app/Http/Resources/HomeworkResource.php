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
            "available_at" => $this->available_at,
            "finished_at" => $this->finished_at,
            "users" => $this->users->pluck('id'),
            "game_type" => $this->gameType->title,
            "difficulty" => DifficultyResource::make($this->difficulty),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];

        $data['games_finished'] = GameUser::query()
            ->where('user_id', auth()->id())
            ->whereIn('game_id', $this->games->pluck('id'))
            ->count();
        $data['next_game'] = Game::query()
            ->where('homework_id', $this->id)
            ->whereDoesntHave('users', fn($query) => $query->where('users.id', auth()->id()))
            ->first();

        return $data;
    }
}
