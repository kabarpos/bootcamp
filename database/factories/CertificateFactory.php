<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => Enrollment::factory(),
            'certificate_no' => 'CERT-' . fake()->date('Ym') . '-' . fake()->unique()->randomNumber(4, true),
            'file_url' => fake()->imageUrl(600, 400, 'certificate'),
            'issued_at' => fake()->optional(0.8)->dateTimeBetween('-6 months', 'now'),
        ];
    }
}