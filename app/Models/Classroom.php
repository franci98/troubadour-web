<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property Collection users
 * @property Collection homeworks
 */
class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }
}
