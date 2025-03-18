@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Booking Management</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->customer->name }}</td>
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
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    {{ $bookings->links('vendor.pagination.bootstrap-4') }} <!-- Pagination -->
    </div>
@endsection
