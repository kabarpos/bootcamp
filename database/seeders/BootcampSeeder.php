<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Bootcamp;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BootcampSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('Menyiapkan data referensi kota...');

        $cityDefinitions = [
            'Jakarta Selatan' => ['country_code' => 'ID', 'timezone' => 'Asia/Jakarta'],
            'Bandung' => ['country_code' => 'ID', 'timezone' => 'Asia/Jakarta'],
            'Surabaya' => ['country_code' => 'ID', 'timezone' => 'Asia/Jakarta'],
            'Yogyakarta' => ['country_code' => 'ID', 'timezone' => 'Asia/Jakarta'],
            'Tangerang Selatan' => ['country_code' => 'ID', 'timezone' => 'Asia/Jakarta'],
            'Denpasar' => ['country_code' => 'ID', 'timezone' => 'Asia/Makassar'],
        ];

        $cities = collect($cityDefinitions)->mapWithKeys(function (array $attributes, string $name) {
            $city = City::updateOrCreate(['name' => $name], $attributes);

            return [$name => $city];
        });

        $this->command?->info('Membersihkan data bootcamp & batch sebelumnya...');

        Batch::query()->delete();
        Bootcamp::query()->delete();

        $bootcamps = [
            [
                'title' => 'Hacktiv8 Full Stack JavaScript',
                'mode' => 'hybrid',
                'level' => 'intermediate',
                'base_price' => 38500000,
                'duration_hours' => 640,
                'short_desc' => 'Program intensif 16 minggu yang fokus pada JavaScript modern, Node.js, dan React untuk menyiapkan talenta full-stack siap kerja.',
                'syllabus_summary' => "Modul 1: Fundamental JavaScript & Version Control.\nModul 2: Frontend Development dengan React.\nModul 3: Backend Development dengan Node.js & Express.\nModul 4: Projek akhir dan sesi career support.",
                'batches' => [
                    [
                        'code' => 'H8-FSJS-ONLINE-OKT25',
                        'start_date' => '2025-10-07',
                        'end_date' => '2026-01-23',
                        'start_time' => '19:00:00',
                        'end_time' => '22:00:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://zoom.us/j/9845623001',
                        'status' => 'upcoming',
                        'capacity' => 40,
                    ],
                    [
                        'code' => 'H8-FSJS-OFFLINE-JKT25',
                        'start_date' => '2025-08-12',
                        'end_date' => '2025-12-05',
                        'start_time' => '09:00:00',
                        'end_time' => '17:00:00',
                        'city' => 'Jakarta Selatan',
                        'venue_name' => 'Hacktiv8 Campus Kemang',
                        'venue_address' => 'Jl. Kemang Raya No. 45, Jakarta Selatan',
                        'status' => 'ongoing',
                        'capacity' => 28,
                    ],
                ],
            ],
            [
                'title' => 'Purwadhika Data Science & Machine Learning',
                'mode' => 'online',
                'level' => 'advanced',
                'base_price' => 42000000,
                'duration_hours' => 520,
                'short_desc' => 'Belajar analisis data, pemodelan machine learning, dan deployment model dengan bimbingan mentor praktisi industri.',
                'syllabus_summary' => "Modul 1: Python untuk Analisis Data.\nModul 2: Statistik Terapan & Exploratory Data Analysis.\nModul 3: Machine Learning Supervised & Unsupervised.\nModul 4: Deep Learning dan Deployment Model.",
                'batches' => [
                    [
                        'code' => 'PWD-DSML-ONLINE-SEP25',
                        'start_date' => '2025-09-09',
                        'end_date' => '2026-01-20',
                        'start_time' => '19:30:00',
                        'end_time' => '22:00:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://zoom.us/j/9988800441',
                        'status' => 'upcoming',
                        'capacity' => 45,
                    ],
                    [
                        'code' => 'PWD-DSML-ONLINE-MEI25',
                        'start_date' => '2025-05-13',
                        'end_date' => '2025-09-23',
                        'start_time' => '19:30:00',
                        'end_time' => '22:00:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://zoom.us/j/9988800455',
                        'status' => 'ongoing',
                        'capacity' => 40,
                    ],
                ],
            ],
            [
                'title' => 'Alterra Academy Backend Engineer',
                'mode' => 'offline',
                'level' => 'intermediate',
                'base_price' => 28500000,
                'duration_hours' => 360,
                'short_desc' => 'Pelatihan backend engineer fokus pada Java & Spring Boot dengan praktik membangun microservices dan REST API.',
                'syllabus_summary' => "Modul 1: OOP dan Best Practice Java.\nModul 2: Spring Boot, RESTful API & Database Design.\nModul 3: Microservices, CI/CD, dan Unit Testing.\nModul 4: Projek akhir kolaboratif.",
                'batches' => [
                    [
                        'code' => 'ALT-BE-OFFLINE-SBY25',
                        'start_date' => '2025-07-07',
                        'end_date' => '2025-10-31',
                        'start_time' => '09:00:00',
                        'end_time' => '16:00:00',
                        'city' => 'Surabaya',
                        'venue_name' => 'Alterra Academy HQ',
                        'venue_address' => 'Jl. Raya Darmo Permai III No. 25, Surabaya',
                        'status' => 'upcoming',
                        'capacity' => 24,
                    ],
                    [
                        'code' => 'ALT-BE-OFFLINE-MLG24',
                        'start_date' => '2024-11-18',
                        'end_date' => '2025-03-07',
                        'start_time' => '09:00:00',
                        'end_time' => '16:00:00',
                        'city' => 'Yogyakarta',
                        'venue_name' => 'Alterra Innovation Space',
                        'venue_address' => 'Jl. Cik Di Tiro No. 9, Yogyakarta',
                        'status' => 'completed',
                        'capacity' => 26,
                    ],
                ],
            ],
            [
                'title' => 'Binar Academy Product Management',
                'mode' => 'online',
                'level' => 'beginner',
                'base_price' => 9500000,
                'duration_hours' => 120,
                'short_desc' => 'Program 14 minggu untuk calon product manager dengan kurikulum berbasis studi kasus dan mentoring mingguan.',
                'syllabus_summary' => "Modul 1: Dasar Product Thinking & Discovery.\nModul 2: Prioritization, Roadmap, dan Delivery.\nModul 3: Metrics, Growth, dan Stakeholder Management.\nModul 4: Final Pitching dan Career Coaching.",
                'batches' => [
                    [
                        'code' => 'BNR-PM-ONLINE-JUL25',
                        'start_date' => '2025-07-22',
                        'end_date' => '2025-10-28',
                        'start_time' => '19:30:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Google Meet',
                        'meeting_link' => 'https://meet.google.com/pm-bootcamp-01',
                        'status' => 'upcoming',
                        'capacity' => 60,
                    ],
                    [
                        'code' => 'BNR-PM-ONLINE-APR25',
                        'start_date' => '2025-04-08',
                        'end_date' => '2025-07-09',
                        'start_time' => '19:30:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Google Meet',
                        'meeting_link' => 'https://meet.google.com/pm-bootcamp-02',
                        'status' => 'ongoing',
                        'capacity' => 55,
                    ],
                ],
            ],
            [
                'title' => 'RevoU Digital Marketing Specialist',
                'mode' => 'online',
                'level' => 'beginner',
                'base_price' => 15500000,
                'duration_hours' => 200,
                'short_desc' => 'Belajar strategi digital marketing end-to-end: performance ads, SEO, content marketing, dan marketing analytics.',
                'syllabus_summary' => "Modul 1: Digital Marketing Fundamentals & Customer Journey.\nModul 2: Performance Marketing (Meta & Google Ads).\nModul 3: Content Strategy, SEO, dan Email Marketing.\nModul 4: Marketing Analytics & Growth Experiment.",
                'batches' => [
                    [
                        'code' => 'REV-DM-ONLINE-AUG25',
                        'start_date' => '2025-08-04',
                        'end_date' => '2025-11-21',
                        'start_time' => '19:00:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://revou.co/bootcamp/dm-aug25',
                        'status' => 'upcoming',
                        'capacity' => 120,
                    ],
                    [
                        'code' => 'REV-DM-ONLINE-MAR25',
                        'start_date' => '2025-03-03',
                        'end_date' => '2025-06-20',
                        'start_time' => '19:00:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://revou.co/bootcamp/dm-mar25',
                        'status' => 'ongoing',
                        'capacity' => 110,
                    ],
                ],
            ],
            [
                'title' => 'Skilvul UI/UX Designer Intensive',
                'mode' => 'hybrid',
                'level' => 'beginner',
                'base_price' => 7800000,
                'duration_hours' => 150,
                'short_desc' => 'Pelatihan UI/UX dari riset pengguna hingga prototyping Figma dengan sesi mentoring desain profesional.',
                'syllabus_summary' => "Modul 1: Design Thinking & Research.\nModul 2: Information Architecture & Wireframing.\nModul 3: Visual Design & Prototyping di Figma.\nModul 4: Pengujian, Iterasi, dan Portfolio Review.",
                'batches' => [
                    [
                        'code' => 'SKV-UIUX-HYBRID-TS25',
                        'start_date' => '2025-06-16',
                        'end_date' => '2025-09-26',
                        'start_time' => '18:30:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://skilvul.com/bootcamp/uiux-hybrid',
                        'city' => 'Tangerang Selatan',
                        'venue_name' => 'Skilvul Innovation Hub BSD',
                        'venue_address' => 'Jl. BSD Grand Boulevard No. 1, Tangerang Selatan',
                        'status' => 'upcoming',
                        'capacity' => 45,
                    ],
                    [
                        'code' => 'SKV-UIUX-HYBRID-DPS24',
                        'start_date' => '2024-12-02',
                        'end_date' => '2025-03-14',
                        'start_time' => '18:30:00',
                        'end_time' => '21:30:00',
                        'meeting_platform' => 'Zoom',
                        'meeting_link' => 'https://skilvul.com/bootcamp/uiux-bali',
                        'city' => 'Denpasar',
                        'venue_name' => 'Skilvul Bali Space',
                        'venue_address' => 'Jl. Teuku Umar Barat No. 368, Denpasar',
                        'status' => 'ongoing',
                        'capacity' => 40,
                    ],
                ],
            ],
        ];

        foreach ($bootcamps as $bootcampData) {
            $batches = Arr::pull($bootcampData, 'batches', []);
            $bootcampData['slug'] = Str::slug($bootcampData['title']);
            $bootcampData['is_active'] = true;

            $bootcamp = Bootcamp::create($bootcampData);

            foreach ($batches as $batchData) {
                $cityName = Arr::pull($batchData, 'city');
                if ($cityName) {
                    $batchData['city_id'] = $cities[$cityName]->id ?? null;
                }

                $batchData['bootcamp_id'] = $bootcamp->id;
                $batchData['meeting_platform'] = $batchData['meeting_platform'] ?? null;
                $batchData['meeting_link'] = $batchData['meeting_link'] ?? null;
                $batchData['venue_name'] = $batchData['venue_name'] ?? null;
                $batchData['venue_address'] = $batchData['venue_address'] ?? null;
                $batchData['start_time'] = $batchData['start_time'] ?? null;
                $batchData['end_time'] = $batchData['end_time'] ?? null;

                Batch::create($batchData);
            }
        }

        $this->command?->info('Seeder bootcamp Indonesia selesai dijalankan.');
    }
}
