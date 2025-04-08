<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard'); // Make sure this view exists
    }

    public function bookings()
    {
        $bookings = Booking::with('customer')->where('customer_id', auth()->id())->paginate(10);
        return view('customer.bookings', compact('bookings')); // Make sure this view exists
    }

    public function index()
    {
        $customers = User::where('role','customer')->latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,unisex',
        ]);


        $request->merge(['role' => 'customer']);
        User::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(User $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required',
        ]);

        $request->merge(['role' => 'customer']);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
