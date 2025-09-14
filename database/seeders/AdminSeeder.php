<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ]
        );

        // Create admin user if it doesn't exist
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign admin role to admin user if not already assigned
        if (!$adminUser->hasRole('admin')) {
            $adminUser->roles()->attach($adminRole->id);
        }

        $this->command->info('Admin role and user created successfully!');
        $this->command->info('Email: admin@admin.com');
        $this->command->info('Password: admin123');
    }
}