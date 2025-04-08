<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Booking;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Default Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes (Only Admin can access)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/admin/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');


    // Admin can manage everything
    Route::resource('services', ServiceController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bookings', BookingController::class);
});

// Customer Routes (Only Customer can access)
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Customers can only see their own bookings
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/bookings', [CustomerController::class, 'bookings'])->name('customer.bookings');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    Route::get('/customer/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile');
    Route::post('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');


    Route::get('/booking/{booking}/pdf', function (Booking $booking) {
        $booking->load('customer', 'staff', 'services');
        $pdf = Pdf::loadView('pdf.booking-confirmation', compact('booking'));
        return $pdf->stream('booking-confirmation.pdf'); // Open in new tab
    })->name('booking.pdf');


});

// Get staff services (Common for both roles)
Route::get('/get-staff-services/{staff}', function ($staff) {
    $staff = Staff::with('services:id,name,price,duration')->find($staff); // Ensure 'duration' is included
    return response()->json($staff ? $staff->services : []);
})->name('staff.services');


