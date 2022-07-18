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

    protected $fillable = [
        'name',
        'game_type_id',
        'difficulty_id',
        'games_required',
        'available_at',
        'finished_at',
    ];

    protected $dates = [
        'available_at',
        'finished_at',
    ];

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

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function createGames()
    {
        for ($i = 0; $i < $this->games_required; $i++) {
            $game = new Game([
                'difficulty_id' => $this->difficulty_id,
                'game_type_id' => $this->game_type_id,
            ]);
            $game->homework()->associate($this);
            $game->save();
            $game->createExercises();
        }
    }
}
