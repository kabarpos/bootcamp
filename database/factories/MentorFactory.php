<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mentor>
 */
class MentorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // Can be null as per migration
            'name' => fake()->name(),
            'headline' => fake()->jobTitle(),
            'bio' => fake()->paragraph(),
            'photo_url' => fake()->imageUrl(200, 200, 'people'),
            'linkedin_url' => fake()->url(),
            'website_url' => fake()->url(),
        ];
    }

    /**
     * Configure the model factory to associate with a user.
     *
     * @return $this
     */
    public function withUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory(),
            ];
        });
    }
}