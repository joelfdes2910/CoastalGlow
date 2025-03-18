@extends('layouts.app')

@section('content')
    <div class="container">

        <h4>My Recent Bookings</h4>
        <br>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{--<a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Add Booking</a>--}}

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                {{--<th>Customer</th>--}}
                <th>Staff</th>
                <th>Date</th>
                <th>Time</th>
                <th>Services</th>
                {{--<th>Actions</th>--}}
            </tr>
            </thead>
            <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{--<td>{{ $booking->customer->name }} {{ $booking->customer->last_name }}</td>--}}
                    <td>{{ $booking->staff->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->date)->format('l, jS F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}</td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($booking->services as $service)
                                <div class="border p-2 rounded bg-light text-dark" style="min-width: 150px;">
                                    <strong class="d-block text-primary">{{ $service->name }}</strong>
                                    <span class="text-muted">🕒 {{ $service->duration }} mins</span>
                                    <span class="d-block text-success fw-bold">💰 ${{ $service->price }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    {{--<td>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>--}}
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
