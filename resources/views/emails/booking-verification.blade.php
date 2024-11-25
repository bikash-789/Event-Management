<!DOCTYPE html>
<html>
<head>
    <title>Booking Verification</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for booking the event <strong>{{ $event->title }}</strong>.</p>
    <p>Please verify your booking by clicking the link below:</p>
    <a href="{{ route('booking.verify', ['bookingId' => $event->id]) }}">Verify Booking</a>
    <p>Thank you!</p>
</body>
</html>
