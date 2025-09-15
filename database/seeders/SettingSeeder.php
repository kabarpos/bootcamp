<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company/Contact Information
        Setting::set('contact_phone', '+1 (555) 123-4567');
        Setting::set('contact_email', 'info@bootcamp.com');
        Setting::set('contact_address', '123 Tech Street, San Francisco, CA 94103');
        
        // Stats
        Setting::set('graduates_count', '5000+');
        Setting::set('placement_rate', '95%');
        Setting::set('partners_count', '25+');
        Setting::set('mentors_count', '100+');
        
        // Events
        Setting::set('event_1_title', 'Web Development Workshop');
        Setting::set('event_1_description', 'Learn the latest web development techniques');
        Setting::set('event_1_date', '2025-10-15');
        Setting::set('event_1_time', '10:00 AM - 2:00 PM');
        
        Setting::set('event_2_title', 'Career Fair');
        Setting::set('event_2_description', 'Meet potential employers and network');
        Setting::set('event_2_date', '2025-10-22');
        Setting::set('event_2_time', '2:00 PM - 6:00 PM');
        
        // Resources
        Setting::set('resource_1_title', 'HTML Cheat Sheet');
        Setting::set('resource_1_description', 'Quick reference guide for HTML5 elements and attributes');
        Setting::set('resource_1_size', '2.4 MB');
        Setting::set('resource_1_action', 'Download PDF');
        Setting::set('resource_1_link', '#');
        
        Setting::set('resource_2_title', 'CSS Flexbox Tutorial');
        Setting::set('resource_2_description', 'Comprehensive video tutorial on CSS Flexbox layout');
        Setting::set('resource_2_size', '45.2 MB');
        Setting::set('resource_2_action', 'Watch Video');
        Setting::set('resource_2_link', '#');
        
        Setting::set('resource_3_title', 'JavaScript Documentation');
        Setting::set('resource_3_description', 'Official MDN documentation for JavaScript');
        Setting::set('resource_3_size', 'Online Resource');
        Setting::set('resource_3_action', 'Visit Site');
        Setting::set('resource_3_link', '#');
    }
}