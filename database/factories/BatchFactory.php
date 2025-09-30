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
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = fake()->dateTimeBetween($startDate->format('Y-m-d'), '+1 year');

        return [
            'bootcamp_id' => Bootcamp::factory(),
            'code' => 'BATCH-' . fake()->unique()->regexify('[A-Z0-9]{6}'),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'start_time' => fake()->time('H:i', '09:00'),
            'end_time' => fake()->time('H:i', '17:00'),
            'city_id' => City::factory(),
            'venue_name' => fake()->company(),
            'venue_address' => fake()->address(),
            'meeting_link' => fake()->optional(0.5)->url(),
            'meeting_platform' => fake()->optional(0.5)->randomElement(['Zoom', 'Google Meet', 'Microsoft Teams']),
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
            'capacity' => fake()->numberBetween(10, 50),
        ];
    }
}
