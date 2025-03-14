<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Staff;
use App\Models\User;
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
            'customer_id' => User::where('role', 'customer')->inRandomOrder()->first()->id,
            'staff_id' => Staff::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'total_price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
