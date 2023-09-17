<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'role'=> UserRole::getRandomValue()
        ]);
        $owner->assignRole(Role::ROLE_OWNER);

        $admin =User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'role'=> UserRole::getRandomValue()
        ]);
        $admin->assignRole(Role::ROLE_ADMIN);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'role'=> UserRole::getRandomValue()
        ]);
        $user->assignRole(Role::ROLE_USER);
    }
}
