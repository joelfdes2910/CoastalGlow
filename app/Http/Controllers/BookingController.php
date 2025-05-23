<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use App\Notifications\NewBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin can see all bookings
            $bookings = Booking::with('customer', 'staff', 'services')->paginate(10);
        } else {
            // Customers can only see their own bookings
            $bookings = Booking::with('staff', 'services')
                ->where('customer_id', Auth::id()) // Restrict to logged-in customer
                ->paginate(10);
        }
        return view('bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['customer', 'staff', 'services', 'payment'])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }


    public function create()
    {
        $customers = User::where('role','customer')->get();
        $staff = Staff::all();
        $services = Service::all();
        return view('bookings.create', compact('customers', 'staff', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id', // Changed 'customers' to 'users'
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'services' => 'required',  // Temporarily remove `array|min:1`
        ]);

        // Debugging: Log incoming data
        \Log::info('Booking Data:', $request->all());

        $booking = Booking::create([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'date' => $request->date,
            'time' => $request->time,
            'total_price' => 0,
        ]);

        // Fetch services
        $services = Service::whereIn('id', $request->services)->get();

        if ($services->isEmpty()) {
            return back()->withErrors(['services' => 'No valid services selected.']);
        }

        $totalPrice = 0;
        $attachData = [];

        foreach ($services as $service) {
            $attachData[$service->id] = ['price' => $service->price];
            $totalPrice += $service->price;
        }

        $booking->services()->attach($attachData);
        $booking->update(['total_price' => $totalPrice]);

        // Calculate total price
        $totalAmount = Service::whereIn('id', $request->services)->sum('price');

        // Store Payment
        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'amount' => $totalAmount,
            'status' => ($request->payment_method == 'cash') ? 'pending' : 'paid',
        ]);

        // Get customer and admin emails
        $customerEmail = $booking->customer->email;
        $adminEmail = 'admin@example.com'; // Replace with your admin email

        // Send email to the customer
        //Mail::to($customerEmail)->send(new BookingConfirmationMail($booking));

        // Send email to admin
       // Mail::to($adminEmail)->send(new BookingConfirmationMail($booking));


       

        // Send notification to Admins
        $adminUsers = User::where('role', 'admin')->get();
        Notification::send($adminUsers, new NewBookingNotification($booking));

        return view('bookings.success', [
            'pdfUrl' => route('booking.pdf', $booking->id),
        ]);

        //return redirect()->route('customer.dashboard')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = User::where('role','customer');
        $staff = Staff::all();
        $selectedServiceIds = $booking->services->pluck('id')->toArray();

        return view('bookings.edit', compact('booking', 'customers', 'staff', 'selectedServiceIds'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
        ]);

        $booking = Booking::findOrFail($id);

        // Update Booking Data
        $booking->update([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Update Services
        $services = Service::whereIn('id', $request->services)->get();
        $totalPrice = $services->sum('price');

        $attachData = [];
        foreach ($services as $service) {
            $attachData[$service->id] = ['price' => $service->price];
        }

        $booking->services()->sync($attachData);
        $booking->update(['total_price' => $totalPrice]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
