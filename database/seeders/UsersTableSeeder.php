<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->firstOrCreate([
            'name' => 'Trubadur admin',
            'email' => 'info@trubadur.si',
            'school_id' => 1
        ], [
            'email_verified_at' => now(),
            'password' => Hash::make('test1234'),
        ]);
        $user->roles()->sync([Role::SUPER_ADMIN => ['status' => RoleUser::STATUS_ACTIVE]]);
    }
}
