<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Category;
use App\Models\Mentor;
use App\Models\Bootcamp;
use App\Models\Batch;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Certificate;
use App\Models\Role;
use App\Models\Permission;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create cities (5)
        City::factory()->count(5)->create();
        $this->command->info('Created 5 cities');

        // Create categories (5)
        Category::factory()->count(5)->create();
        $this->command->info('Created 5 categories');

        // Create mentors (5)
        Mentor::factory()->count(5)->create();
        $this->command->info('Created 5 mentors');

        // Create bootcamps (5)
        $bootcamps = Bootcamp::factory()->count(5)->create();
        $this->command->info('Created 5 bootcamps');

        // Create batches (5)
        $batches = Batch::factory()->count(5)->create();
        $this->command->info('Created 5 batches');

        // Create vouchers (5)
        Voucher::factory()->count(5)->create();
        $this->command->info('Created 5 vouchers');

        // Create users (5)
        $users = User::factory()->count(5)->create();
        $this->command->info('Created 5 users');

        // Create roles (5)
        $roles = Role::factory()->count(5)->create();
        $this->command->info('Created 5 roles');

        // Create permissions (5) - only create if they don't already exist
        $permissions = [];
        $existingPermissions = Permission::pluck('name')->toArray();
        $neededPermissions = 5;
        $createdCount = 0;
        
        // Try to create permissions, but skip if they already exist
        for ($i = 0; $i < $neededPermissions * 2; $i++) { // Try more times to account for duplicates
            if (count($permissions) >= $neededPermissions) {
                break;
            }
            
            $permission = Permission::factory()->make();
            
            // Check if permission already exists
            if (!in_array($permission->name, $existingPermissions)) {
                $permission->save();
                $permissions[] = $permission;
                $existingPermissions[] = $permission->name;
                $createdCount++;
            }
        }
        
        $this->command->info("Created {$createdCount} permissions");

        // Create enrollments (5)
        $enrollments = Enrollment::factory()->count(5)->create();
        $this->command->info('Created 5 enrollments');

        // Create orders (5)
        $orders = Order::factory()->count(5)->create();
        $this->command->info('Created 5 orders');

        // Create certificates (5)
        $certificates = Certificate::factory()->count(5)->create();
        $this->command->info('Created 5 certificates');

        // Associate bootcamps with categories and mentors
        foreach ($bootcamps as $bootcamp) {
            $categories = Category::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $mentors = Mentor::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            
            $bootcamp->categories()->attach($categories);
            $bootcamp->mentors()->attach($mentors);
        }
        $this->command->info('Associated bootcamps with categories and mentors');

        // Associate users with roles
        foreach ($users as $user) {
            $userRoles = $roles->random(rand(1, 2))->pluck('id');
            $user->roles()->attach($userRoles);
        }
        $this->command->info('Associated users with roles');

        // Associate roles with permissions
        foreach ($roles as $role) {
            if (count($permissions) > 0) {
                $rolePermissions = collect($permissions)->random(min(rand(2, 4), count($permissions)))->pluck('id');
                $role->permissions()->attach($rolePermissions);
            }
        }
        $this->command->info('Associated roles with permissions');

        $this->command->info('Test data seeding completed successfully!');
    }
}