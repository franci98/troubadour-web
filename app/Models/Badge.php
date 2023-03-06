<?php

namespace App\Models;

use App\Utils\BadgeChecker\BadgeCheckInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property BadgeCheckInterface implemented_in
 * @property array options
 */
class Badge extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array',
    ];

    public function hasBeenAchievedBy(User $user): bool
    {
        return $user->badges()->where('badge_id', $this->id)->exists();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'badge_user');
    }

    public function checkIfAchievedBy(User $user): bool
    {
        if ($this->implemented_in == null) {
            return false;
        }

        $badgeChecker = $this->implemented_in;
        return $badgeChecker::check($user, $this->options ?: []);
    }

    public function checkProgressOf(User $user): ?float
    {
        if ($this->implemented_in == null) {
            return null;
        }

        $badgeChecker = $this->implemented_in;
        return $badgeChecker::checkProgress($user, $this->options ?: []);
    }
}
