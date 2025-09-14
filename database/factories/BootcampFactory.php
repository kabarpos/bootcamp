<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Mentor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bootcamp>
 */
class BootcampFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'mode' => fake()->randomElement(['online', 'offline', 'hybrid']),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'base_price' => fake()->randomFloat(2, 100000, 5000000),
            'duration_hours' => fake()->numberBetween(10, 100),
            'short_desc' => fake()->paragraph(),
            'syllabus_summary' => fake()->paragraphs(3, true),
            'is_active' => fake()->boolean(80), // 80% chance of being active
        ];
    }
}