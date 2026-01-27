<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@yuvaanltd.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@yuvaanltd.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Create Developer User
        User::updateOrCreate(
            ['email' => 'developer@yuvaanltd.com'],
            [
                'name' => 'Developer',
                'email' => 'developer@yuvaanltd.com',
                'password' => Hash::make('developer123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Admin: admin@yuvaanltd.com / admin123');
        $this->command->info('Developer: developer@yuvaanltd.com / developer123');
    }
}
