<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;
use App\Models\Voucher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 100000, 5000000);
        $discountAmount = fake()->randomFloat(2, 0, $amount * 0.5);
        $total = $amount - $discountAmount;
        
        return [
            'enrollment_id' => Enrollment::factory(),
            'invoice_no' => 'INV-' . fake()->date('Ymd') . '-' . fake()->unique()->randomNumber(4, true),
            'amount' => $amount,
            'discount_amount' => $discountAmount,
            'total' => $total,
            'voucher_id' => fake()->optional(0.3)->randomElement([null, Voucher::factory()]),
            'status' => fake()->randomElement(['pending', 'paid', 'expired', 'failed', 'refunded']),
            'expired_at' => fake()->optional(0.3)->dateTimeBetween('now', '+1 month'),
        ];
    }
}