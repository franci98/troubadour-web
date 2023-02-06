<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function completionPercentageFor(User $user)
    {
        $total = $this->max_rating - $this->min_rating;
        $current = $user->total_points - $this->min_rating;

        if ($current > $total) {
            return 100;
        } elseif ($current < 0) {
            return 0;
        } else {
            return $current / $total * 100;
        }
    }
}
