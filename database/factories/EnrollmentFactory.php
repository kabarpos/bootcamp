<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Batch;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'batch_id' => Batch::factory(),
            'referral_id' => null, // Set to null for now to avoid foreign key issues
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}