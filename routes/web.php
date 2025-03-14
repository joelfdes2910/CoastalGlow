<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('staff', StaffController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('bookings', BookingController::class);
});

Route::get('/get-staff-services/{staff}', function ($staff) {
    $staff = Staff::with('services:id,name,price')->find($staff);

    if (!$staff) {
        return response()->json([]);
    }

    return response()->json($staff->services);
})->name('staff.services');
