<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        body { font-family: sans-serif; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
    <p><strong>Customer:</strong> {{ $booking->customer->name }}</p>
    <p><strong>Staff:</strong> {{ $booking->staff->name }}</p>
    <p><strong>Date:</strong> {{ $booking->date }}</p>
    <p><strong>Time:</strong> {{ $booking->time }}</p>
    <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>

    <h3>Services:</h3>
    <ul>
        @foreach($booking->services as $service)
            <li>{{ $service->name }} - ${{ number_format($service->price, 2) }}</li>
        @endforeach
    </ul>
</body>
</html>
