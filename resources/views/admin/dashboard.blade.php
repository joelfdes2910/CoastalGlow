@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalServices }}</h3>
                        <p>Total Services</p>
                    </div>
                    <div class="icon"><i class="fas fa-cogs"></i></div>
                    <a href="{{ route('services.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalStaff }}</h3>
                        <p>Total Staff</p>
                    </div>
                    <div class="icon"><i class="fas fa-user-tie"></i></div>
                    <a href="{{ route('staff.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalCustomers }}</h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <a href="{{ route('customers.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalBookings }}</h3>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon"><i class="fas fa-calendar-check"></i></div>
                    <a href="{{ route('bookings.index') }}" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Recent Bookings</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-primary">
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
                            <td><span class="badge badge-primary">Confirmed</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Bookings Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
