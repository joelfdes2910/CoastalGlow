@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalServices }}</h3>
                        <p>Total Services</p>
                    </div>
                    <div class="icon"><i class="fas fa-cogs"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalStaff }}</h3>
                        <p>Total Staff</p>
                    </div>
                    <div class="icon"><i class="fas fa-user-tie"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalCustomers }}</h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon"><i class="fas fa-users"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalBookings }}</h3>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon"><i class="fas fa-calendar-check"></i></div>
                </div>
            </div>
        </div>

        <h4 class="mt-5">Recent Bookings</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($recentBookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->customer->name }}</td>
                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                    <td><span class="badge bg-success">Confirmed</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Bookings Found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
