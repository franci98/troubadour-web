<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
