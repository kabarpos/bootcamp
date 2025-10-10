<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bootcamp;
use App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static array $templates = [
        [
            'code' => 'BATCH-JKT-ONLINE',
            'start_date' => '2025-07-15',
            'end_date' => '2025-11-28',
            'start_time' => '19:00:00',
            'end_time' => '22:00:00',
            'meeting_platform' => 'Zoom',
            'meeting_link' => 'https://zoom.us/j/1234567890',
            'status' => 'upcoming',
            'capacity' => 35,
        ],
        [
            'code' => 'BATCH-BDG-OFFLINE',
            'start_date' => '2025-08-05',
            'end_date' => '2025-12-19',
            'start_time' => '09:00:00',
            'end_time' => '16:00:00',
            'city' => 'Bandung',
            'venue_name' => 'Coworking Space Bandung Digital Valley',
            'venue_address' => 'Jl. Gegerkalong Hilir No.47, Bandung',
            'status' => 'upcoming',
            'capacity' => 28,
        ],
        [
            'code' => 'BATCH-SBY-WEEKEND',
            'start_date' => '2025-09-07',
            'end_date' => '2025-12-14',
            'start_time' => '10:00:00',
            'end_time' => '15:00:00',
            'city' => 'Surabaya',
            'venue_name' => 'Alterra Academy HQ',
            'venue_address' => 'Jl. Raya Darmo Permai III No.25, Surabaya',
            'status' => 'upcoming',
            'capacity' => 24,
        ],
    ];

    protected static int $sequence = 0;

    public function definition(): array
    {
        $template = static::$templates[static::$sequence % count(static::$templates)];
        static::$sequence++;

        $batch = array_merge($template, [
            'bootcamp_id' => Bootcamp::factory(),
            'start_time' => $template['start_time'] ?? null,
            'end_time' => $template['end_time'] ?? null,
            'meeting_platform' => $template['meeting_platform'] ?? null,
            'meeting_link' => $template['meeting_link'] ?? null,
            'venue_name' => $template['venue_name'] ?? null,
            'venue_address' => $template['venue_address'] ?? null,
            'status' => $template['status'] ?? 'upcoming',
            'capacity' => $template['capacity'] ?? 30,
        ]);

        $cityName = $template['city'] ?? null;
        unset($batch['city']);

        if ($cityName) {
            $city = City::firstOrCreate([
                'name' => $cityName,
            ], [
                'country_code' => 'ID',
                'timezone' => 'Asia/Jakarta',
            ]);

            $batch['city_id'] = $city->id;
        } else {
            $batch['city_id'] = null;
        }

        return $batch;
    }
}
