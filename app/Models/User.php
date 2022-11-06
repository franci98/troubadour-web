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

    public function assignRole(int $roleId, int $status = RoleUser::STATUS_UNCONFIRMED)
    {
        $this->roles()->attach($roleId, ['status' => $status]);
    }

    public function isTeacher(): bool
    {
        return $this->hasAnyRole([Role::TEACHER]);
    }

    public function isAdmin(): bool
    {
        return $this->hasAnyRole([Role::ADMIN]);
    }

    public function hasAnyRole(array $roleIds): bool
    {
        return $this->roles()
            ->whereIn('role_id', $roleIds)
            ->wherePivot('status', RoleUser::STATUS_ACTIVE)
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
}
