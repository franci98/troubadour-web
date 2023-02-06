<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property int school_id
 * @property School school
 * @property Collection classrooms
 * @property Collection teachersClassrooms
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'school_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teachersClassrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function shool()
    {
        return $this->belongsTo(School::class);
    }

    public function assignRole(int $roleId)
    {
        if ($this->roles()->where('role_id', $roleId)->exists()) {
            return;
        }
        $this->roles()->attach($roleId);
    }

    public function removeRole(int $roleId)
    {
        $this->roles()->detach($roleId);
    }

    public function isTeacher(): bool
    {
        return $this->hasAnyRole([Role::TEACHER]);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasAnyRole([Role::SUPER_ADMIN]);
    }

    public function hasAnyRole(array $roleIds): bool
    {
        return $this->roles()
            ->whereIn('role_id', $roleIds)
            ->exists();
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_user')
            ->withPivot(['points', 'is_finished'])
            ->withTimestamps();
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'badge_user')
            ->withTimestamps();
    }

    public function achievedPointsOn(Carbon $date): int
    {
        return $this->games()
            ->where('is_finished', true)
            ->whereBetween('game_user.created_at', [$date->startOfDay(), $date->copy()->endOfDay()])
            ->sum('points');
    }

    public function isTeacherOf(Classroom $classroom)
    {
        return $this->isTeacher() && $this->teachersClassrooms()->where('id', $classroom->id)->exists();
    }

    public function unachievedBadges(): Collection
    {
        return Badge::query()->whereDoesntHave('users', function ($query) {
            $query->where('user_id', $this->id);
        })->get();
    }

    public function isSchoolAdmin(): bool
    {
        return $this->hasAnyRole([Role::SCHOOL_ADMIN]);
    }

    public function isSchoolAdminOf(School $school): bool
    {
        return $this->isSchoolAdmin() && $this->school_id === $school->id;
    }

    public function getTotalPointsAttribute(): float
    {
        return (float) GameUser::query()->where('user_id', $this->id)->sum('points');
    }

    public function delete()
    {
        $this->roles()->detach();
        $this->classrooms()->detach();
        foreach ($this->teachersClassrooms as $teachersClassroom) {
            $teachersClassroom->delete();
        }
        $this->games()->detach();
        $this->badges()->detach();

        return parent::delete();
    }
}
