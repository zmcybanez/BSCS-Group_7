<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BypassUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'bypass@example.com';
        $passwordPlain = 'BypassPass123!';

        $hash = Hash::make($passwordPlain);

        // Use raw DB to avoid Eloquent casts re-hashing
        DB::table('users')->updateOrInsert(
            ['email' => $email],
            [
                'name' => 'Bypass User',
                'email' => $email,
                'password' => $hash,
                'role' => 'admin',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
