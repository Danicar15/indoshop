<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $name = env('ADMIN_NAME');
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        // Admin account is created only when all three values are configured in .env.
        if (! $name || ! $email || ! $password) {
            $this->command?->warn('Admin skipped: set ADMIN_NAME, ADMIN_EMAIL and ADMIN_PASSWORD in .env.');
            return;
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );
    }
}
