<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Category;
use App\Models\Mentor;
use App\Models\Bootcamp;
use App\Models\Batch;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Certificate;
use App\Models\BlogPost;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create cities (5)
        $cities = City::factory()->count(5)->create();
        $this->command->info('Created 5 cities');

        // Create categories (5)
        $categories = Category::factory()->count(5)->create();
        $this->command->info('Created 5 categories');

        // Create mentors (5)
        $mentors = Mentor::factory()->count(5)->create();
        $this->command->info('Created 5 mentors');

        // Create bootcamps (5)
        $bootcamps = Bootcamp::factory()->count(5)->create();
        $this->command->info('Created 5 bootcamps');

        // Create batches (5)
        $batches = Batch::factory()->count(5)->create();
        $this->command->info('Created 5 batches');

        // Create vouchers (5)
        $vouchers = Voucher::factory()->count(5)->create();
        $this->command->info('Created 5 vouchers');

        // Create users (5)
        $users = User::factory()->count(5)->create();
        $this->command->info('Created 5 users');

        // Create roles (5)
        $roles = Role::factory()->count(5)->create();
        $this->command->info('Created 5 roles');

        // Create permissions (5)
        $permissions = Permission::factory()->count(5)->create();
        $this->command->info('Created 5 permissions');

        // Create blog posts (5)
        $blogPosts = BlogPost::factory()->count(5)->published()->create();
        $this->command->info('Created 5 blog posts');

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
        
        // Associate roles with permissions
        foreach ($roles as $role) {
            $rolePermissions = $permissions->random(rand(1, 3))->pluck('id');
            $role->permissions()->attach($rolePermissions);
        }
        
        $this->command->info('Associated users with roles and roles with permissions');
        $this->command->info('Test data seeding completed successfully!');
    }
}