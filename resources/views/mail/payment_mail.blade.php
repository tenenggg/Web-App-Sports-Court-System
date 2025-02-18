<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Your Payment Confirmation</h1>
    <p>Thank you for your payment!</p>
    <p>Here are your booking details:</p>
    <ul>
        <li>Booking ID: {{ $order['booking_id'] }}</li>
        <li>Booking Date: {{ $order['booking_date'] }}</li>
        <li>Time: {{ $order['start_time'] }} - {{ $order['end_time'] }}</li>
        <li>Total Price: RM {{ number_format($order['total_price'], 2) }}</li>
        <li>Status: {{ $order['status'] }}</li>
    </ul>
    <p>Thank you for using our service!</p>
</body>
</html>
