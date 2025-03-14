@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Bookings</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Staff</th>
                <th>Date</th>
                <th>Time</th>
                <th>Services</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->customer->first_name }} {{ $booking->customer->last_name }}</td>
                    <td>{{ $booking->staff->name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time }}</td>
                    <td>
                        @foreach($booking->services as $service)
                            <span class="badge bg-info">{{ $service->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No Bookings found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $bookings->links('vendor.pagination.bootstrap-4') }} <!-- Pagination -->

    </div>
@endsection
