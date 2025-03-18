<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Default Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes (Only Admin can access)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

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
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    Route::get('/customer/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile');
    Route::post('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');


});

// Get staff services (Common for both roles)
Route::get('/get-staff-services/{staff}', function ($staff) {
    $staff = Staff::with('services:id,name,price')->find($staff);
    return response()->json($staff ? $staff->services : []);
})->name('staff.services');
