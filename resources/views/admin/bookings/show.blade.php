@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')
    <div class="container">
        <h3>Booking Details</h3>
        <p><strong>Customer:</strong> {{ $booking->customer->name }}</p>
        <p><strong>Staff:</strong> {{ $booking->staff->name }}</p>
        <p><strong>Date:</strong> {{ $booking->date }}</p>
        <p><strong>Time:</strong> {{ $booking->time }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($booking->payment->amount ?? 0, 2) }}</p>

        <h4>Services</h4>
        <ul>
            @foreach($booking->services as $service)
                <li>{{ $service->name }} - ${{ number_format($service->pivot->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
@endsection
