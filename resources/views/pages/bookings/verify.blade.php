<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Verification</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #333; text-align: center;">Booking Verification</h2>
        <p>Hello {{ $user->name }},</p>
        <p>Thank you for booking an event with us. Please click the button below to verify your booking:</p>
        <div style="text-align: center; margin: 20px 0;">
            <a href="{{ $verificationUrl }}" 
               style="display: inline-block; background-color: #28a745; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px;">
                Verify Booking
            </a>
        </div>
        <p>If the button above doesn't work, copy and paste the following link into your browser:</p>
        <p style="word-wrap: break-word;">{{ $verificationUrl }}</p>
        <p style="margin-top: 20px; font-size: 14px; color: #777;">
            If you did not make this booking, please ignore this email.
        </p>
        <p style="margin-top: 20px; font-size: 14px; color: #777;">
            Regards,<br>
            The {{ config('app.name') }} Team
        </p>
    </div>
</body>
</html>
