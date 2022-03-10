<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int sequence
 */
class Difficulty extends Model
{
    use HasFactory;

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
}
