<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['percent', 'amount']);
        $value = $type === 'percent' ? fake()->numberBetween(5, 50) : fake()->numberBetween(10000, 100000);
        
        return [
            'code' => 'VOUCHER-' . fake()->unique()->regexify('[A-Z0-9]{6}'),
            'type' => $type,
            'value' => $value,
            'max_discount' => $type === 'percent' ? fake()->numberBetween(50000, 200000) : null,
            'valid_from' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'valid_to' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'usage_limit' => fake()->optional(0.7)->numberBetween(1, 100),
            'used_count' => 0,
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}