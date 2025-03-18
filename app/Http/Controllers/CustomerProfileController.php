<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerProfileController extends Controller
{
    public function edit()
    {
        $customer = Auth::user(); // Get the logged-in user
        return view('customer.profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::user();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($customer->id)],
            'phone' => 'nullable|string|max:15',
        ]);

        // Update customer details
        $customer->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully.');
    }
}
