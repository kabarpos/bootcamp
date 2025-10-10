<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the AdminSeeder
        $this->call(AdminSeeder::class);
        
        // Run the SettingSeeder to create settings data
        $this->call(SettingSeeder::class);

        // Seed default WhatsApp templates
        $this->call(WhatsappTemplateSeeder::class);
        
        // Run the TestDataSeeder to create sample data
        $this->call(TestDataSeeder::class);
        
        // Note: Test users should be created manually or through registration, not automatically
        // The following line has been removed for security reasons:
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
