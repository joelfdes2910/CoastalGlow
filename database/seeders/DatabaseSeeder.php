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
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);



        // Create Customers
        $customers = User::factory(10)->create([
            'role' => 'customer',
        ]);

        // Create Services
        $services = Service::factory(10)->create();

        // Create Staff
        $staff = Staff::factory(5)->create();

        // Create Bookings
        $bookings = Booking::factory(10)->create([
            'customer_id' => $customers->random()->id,
            'staff_id' => $staff->random()->id,
        ]);

        // Attach Services to Bookings
        $bookings->each(function ($booking) use ($services) {
            $booking->services()->attach(
                $services->random(rand(1, 3))->pluck('id')->toArray(),
                ['price' => fake()->randomFloat(2, 10, 100)]
            );
        });

        // Create Payments for Bookings
        $bookings->each(function ($booking) {
            Payment::factory()->create(['booking_id' => $booking->id]);
        });

        // Create Carts
        $carts = Cart::factory(10)->create();

        // Create Cart Items
        $carts->each(function ($cart) use ($services) {
            CartItem::factory(3)->create([
                'cart_id' => $cart->id,
                'service_id' => $services->random()->id,
            ]);
        });
    }
}
