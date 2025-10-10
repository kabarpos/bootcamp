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
        $this->call(WhatsappTemplateSeeder::class);
        $this->call(EmailTemplateSeeder::class);

        // Seed bootcamp dan batch nyata
        $this->call(BootcampSeeder::class);
        
        // Note: Test users should be created manually or through registration, not automatically
        // The following line has been removed for security reasons:
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
