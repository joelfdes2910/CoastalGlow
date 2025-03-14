<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalServices' => Service::count(),
            'totalStaff' => Staff::count(),
            'totalCustomers' => Customer::count(),
            'totalBookings' => Booking::count(),
            'recentBookings' => Booking::latest()->limit(5)->get()
        ]);
    }
}
