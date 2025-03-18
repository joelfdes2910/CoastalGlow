<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function show($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
            return redirect()->route('bookings.show', $notification->data['booking_id']);
        }

        return redirect()->route('notifications.index')->with('error', 'Notification not found.');
    }
}
