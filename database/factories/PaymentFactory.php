<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'payment_method' => $this->faker->randomElement(['cash', 'card', 'online']),
            'transaction_id' => $this->faker->uuid,
            'amount' => $this->faker->randomFloat(2, 20, 200),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
        ];
    }
}
