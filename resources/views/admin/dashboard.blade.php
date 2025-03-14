@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5>Total Services</h5>
                    <h3>{{ $totalServices }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5>Total Staff</h5>
                    <h3>{{ $totalStaff }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <h5>Total Customers</h5>
                    <h3>{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center bg-danger text-white">
                <div class="card-body">
                    <h5>Total Bookings</h5>
                    <h3>{{ $totalBookings }}</h3>
                </div>
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
        @foreach($recentBookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->customer->first_name }} {{ $booking->customer->last_name }}</td>
                <td>{{ $booking->created_at->format('d M Y') }}</td>
                <td><span class="badge bg-success">Confirmed</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
