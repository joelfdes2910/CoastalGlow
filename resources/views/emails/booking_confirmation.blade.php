<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
<h2>Dear {{ $booking->customer->name }},</h2>
<p>Thank you for booking with us!</p>

<h3>Booking Details:</h3>
<p><strong>Stylist:</strong> {{ $booking->staff->name }}</p>
<p><strong>Date:</strong> {{ $booking->date }}</p>
<p><strong>Time:</strong> {{ $booking->time }}</p>

<h4>Services:</h4>
<ul>
    @foreach ($booking->services as $service)
        <li>{{ $service->name }} - ${{ $service->price }}</li>
    @endforeach
</ul>

<p><strong>Total Price:</strong> ${{ $booking->total_price }}</p>

<p>We look forward to seeing you!</p>
</body>
</html>
