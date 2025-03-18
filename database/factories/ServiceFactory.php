<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $spaServices = [
            ['name' => 'Facial Treatment', 'duration' => 60, 'price' => 60],
            ['name' => 'Body Scrub', 'duration' => 50, 'price' => 55],
            ['name' => 'Manicure & Pedicure', 'duration' => 90, 'price' => 65],
            ['name' => 'Thai Massage', 'duration' => 90, 'price' => 85],
            ['name' => 'Mud Wrap', 'duration' => 60, 'price' => 80],

            // Salon Services
            ['name' => 'Haircut & Styling', 'duration' => 45, 'price' => 40],
            ['name' => 'Hair Coloring', 'duration' => 90, 'price' => 120],
            ['name' => 'Keratin Treatment', 'duration' => 120, 'price' => 150],
            ['name' => 'Manicure & Pedicure', 'duration' => 90, 'price' => 65],
            ['name' => 'Eyebrow Threading & Tinting', 'duration' => 30, 'price' => 25],
        ];

        // Pick a random service from the list
        $service = $this->faker->randomElement($spaServices);

        return [
            'name' => $service['name'],
            'description' => $this->faker->sentence,
            'duration' => $service['duration'],
            'price' => $service['price'],
            'status' => $this->faker->boolean,
        ];
    }
}
