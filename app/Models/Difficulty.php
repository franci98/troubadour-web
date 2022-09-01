<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string title
 * @property Collection parameters
 * @property int sequence
 */
class Difficulty extends Model
{
    use HasFactory;

    protected $casts = [
        'parameters' => 'array'
    ];

    public function getEasierDifficulties(bool $including = false): Collection
    {
        return Difficulty::query()
            ->where('sequence', $including ? '<=' : '<', $this->sequence)
            ->get();
    }

    public function getHarderDifficulties(bool $including = false)
    {
        return Difficulty::query()
            ->where('sequence', $including ? '>=' : '>', $this->sequence)
            ->get();
    }

    public function getPointsForUser(User $user): int
    {
        return GameUser::query()
            ->where('user_id', $user->id)
            ->join('games', 'games.id', '=', 'game_user.game_id')
            ->where('games.difficulty_id', $this->id)
            ->where('is_finished', true)
            ->get()
            ->sum('points');
    }

    public function getNumberOfGamesForUser(User $user): int
    {
        return GameUser::query()
            ->where('user_id', $user->id)
            ->join('games', 'games.id', '=', 'game_user.game_id')
            ->where('games.difficulty_id', $this->id)
            ->where('is_finished', true)
            ->get()
            ->count();
    }
}
