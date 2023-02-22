<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['email' => 'admin@admin.com', 'password' => 'password', 'name' => 'Admin', 'role' => Role::ADMIN],
        ];
        foreach ($users as $user) {
            if (User::where('email', $user['email'])->exists()) {
                continue;
            }

            $newUser = User::firstOrCreate(['email' => $user['email']], [
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'name' => $user['name']
            ]);

            $newUser->roles()->attach(Role::getBy($user['role']));
        }
    }
}
