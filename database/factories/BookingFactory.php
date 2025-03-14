<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'staff_id' => Staff::factory(),
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'total_price' => $this->faker->randomFloat(2, 20, 200),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled', 'completed']),
        ];
    }
}
