<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string name
 * @property int games_required
 * @property Carbon available_at
 * @property Carbon finished_at
 * @property Difficulty difficulty
 * @property GameType gameType
 * @property Game[] games
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

    public function gameType()
    {
        return $this->belongsTo(GameType::class);
    }

    public function difficulty()
    {
        return $this->belongsTo(Difficulty::class);
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

    public function delete()
    {
        HomeworkUser::query()->where('homework_id', $this->id)->delete();
        foreach ($this->games as $game) {
            $game->delete();
        }
        return parent::delete();
    }

    public function countGamesOf(User $user): int
    {
        return $this->getPlayedGames($user)->count();
    }

    public function scoreOf(User $user): int
    {
        return $this->getPlayedGames($user)->sum('points');
    }

    // Returns all the homework games that the user has played and finished
    public function getPlayedGames(User $user): Collection
    {
        return GameUser::query()
            ->whereIn('game_id', $this->games->pluck('id'))
            ->where('user_id', $user->id)
            ->where('is_finished', true)
            ->get();
    }

    // Get finished game_ids of the user
    public function getPlayedGameIds(User $user): Collection
    {
        return $this->getPlayedGames($user)->pluck('game_id')->unique('game_id');
    }

    public function getNotPlayedGames(User $user): Collection
    {
        return $this->games()->whereNotIn('id', $this->getPlayedGameIds($user))->get();
    }
}
