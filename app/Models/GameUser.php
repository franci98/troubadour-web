<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int id
 * @property User user
 * @property Game game
 * @property int points
 * @property bool is_finished
 * @property Carbon created_at
 */
class GameUser extends Model
{
    use HasFactory;

    public function addPoints(int $points)
    {
        $this->points += $points;
        $this->is_finished = true;
        $this->save();
    }
}
