<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int id
 */
class Homework extends Model
{
    use HasFactory;

    protected $table = 'homeworks';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function addUser(User $user)
    {
        $this->users()->attach($user);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function createGames(int $difficulty)
    {
        for ($i = 0; $i < $this->games_required; $i++) {
            $game = new Game();
            $game->homework()->associate($this);
            $game->save();
            $game->createExercises();
        }
    }
}
