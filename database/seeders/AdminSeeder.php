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
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        $adminPassword = env('ADMIN_PASSWORD');
        $adminName = env('ADMIN_NAME', 'Administrator');

        if (empty($adminPassword)) {
            $adminPassword = 'password';
            $this->command?->warn('ADMIN_PASSWORD belum diatur, menggunakan password default "password" untuk akun admin.');
        }

        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ]
        );

        // Create or update the admin user
        $adminUser = User::firstOrNew(['email' => $adminEmail]);
        $adminUser->name = $adminName;
        $adminUser->email = $adminEmail;
        $adminUser->password = Hash::make($adminPassword);
        $adminUser->email_verified_at = $adminUser->email_verified_at ?? now();
        $adminUser->save();

        // Assign admin role to admin user if not already assigned
        if (!$adminUser->hasRole('admin')) {
            $adminUser->roles()->attach($adminRole->id);
        }

        $this->command?->info('Admin role seeded successfully.');
        $this->command?->info(sprintf('Admin account: %s', $adminEmail));
        $this->command?->info('Remember to keep the ADMIN_PASSWORD secret.');
    }
}
