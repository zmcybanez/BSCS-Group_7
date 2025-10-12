<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test User',
                'email' => 'user@example.com',
                'role' => 'user',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Glen Laurence Lagata',
                'email' => 'glenlaurencelagata@gmail.com',
                'role' => 'user',
                'password' => Hash::make('laurencancer11'),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']], // unique check by email
                array_merge($user, [
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ])
            );
        }
    }
}
