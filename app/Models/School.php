<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property Classroom[] classrooms
 */
class School extends Model
{
    use HasFactory;

    const NO_SCHOOL_ID = 1;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class, User::class);
    }

    public function schoolAdmins()
    {
        return $this->users()
            ->where('school_id', $this->id)
            ->whereHas('roles', function ($query) {
                $query->where('roles.id', Role::SCHOOL_ADMIN);
            });
    }

    public function delete()
    {
        $this->schoolAdmins()->get()->each(function ($user) {
            $user->roles()->detach(Role::SCHOOL_ADMIN);
        });
        $this->users()->update(['school_id' => self::NO_SCHOOL_ID]);
        foreach ($this->classrooms as $classroom) {
            $classroom->delete();
        }
        return parent::delete();
    }
}
