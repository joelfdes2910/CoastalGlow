<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => Hash::make('admin'),
         ]);


		// Create staff
        $staff = Staff::factory(5)->create();

        // Create services
        $services = Service::factory(10)->create();

        // Assign services to staff
//        $staff->each(function ($staffMember) use ($services) {
//            $staffMember->services()->syncWithoutDetaching(
//                $services->random(rand(2, 5))->pluck('id')->toArray()
//            );
//        });


        $staff->each(function ($staffMember) use ($services) {
            $staffMember->services()->attach(
                $services->random(rand(2, 5))->pluck('id')->toArray()
            );
        });


        // Create customers
        $customers = Customer::factory(10)->create();

        // Create bookings
        $bookings = Booking::factory(10)->create();

        $bookings->each(function ($booking) use ($services) {
            $booking->services()->attach(
                $services->random(rand(1, 3))->pluck('id')->toArray(),
                ['quantity' => rand(1, 3), 'price' => fake()->randomFloat(2, 10, 100)]
            );
        });

        // Create payments
        $bookings->each(function ($booking) {
            Payment::factory()->create(['booking_id' => $booking->id]);
        });

        // Create carts
        $carts = Cart::factory(10)->create();

        // Create cart items
        $carts->each(function ($cart) use ($services) {
            CartItem::factory(3)->create([
                'cart_id' => $cart->id,
                'service_id' => $services->random()->id,
            ]);
        });
    }
}
