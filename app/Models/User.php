<?php

namespace App\Models;

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
 * @property Collection classrooms
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
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
            ->with('status')
            ->withTimestamps();
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function assignRole(int $roleId, int $status = RoleUser::STATUS_UNCONFIRMED)
    {
        $this->roles()->attach($roleId, ['status' => $status]);
    }

    public function isTeacher(): bool
    {
        return $this->hasAnyRole([Role::TEACHER]);
    }

    public function hasAnyRole(array $roleIds): bool
    {
        return $this->roles()
            ->whereIn('role_id', $roleIds)
            ->wherePivot('status', RoleUser::STATUS_ACTIVE)
            ->exists();
    }
}
