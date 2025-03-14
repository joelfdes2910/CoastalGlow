<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->paginate(10);
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $services = Service::all(); // Fetch services for dropdown
        return view('staff.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'services' => 'required|array', // Ensure at least one service is selected
            'services.*' => 'exists:services,id',
        ]);

        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $staff->services()->attach($request->services); // Attach selected services

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(Staff $staff)
    {
        $services = Service::all(); // Fetch services for dropdown
        return view('staff.edit', compact('staff', 'services'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $staff->id,
            'phone' => 'nullable|string|max:20',
            'services' => 'required|array', // Ensure at least one service is selected
            'services.*' => 'exists:services,id',
        ]);

        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $staff->services()->sync($request->services); // Sync selected services

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member deleted successfully.');
    }
}
