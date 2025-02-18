<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Payment Confirmation</h2>
        </div>

        <div class="details">
            <p>Dear Customer,</p>
            
            <p>Thank you for your payment. Your booking has been confirmed.</p>

            <h3>Booking Details:</h3>
            <ul>
                <li>Booking ID: {{ $booking_id }}</li>
                <li>Booking Date: {{ $booking_date }}</li>
                <li>Start Time: {{ $start_time }}</li>
                <li>End Time: {{ $end_time }}</li>
                <li>Total Amount: RM {{ number_format($total_price, 2) }}</li>
                <li>Status: {{ ucfirst($status) }}</li>
            </ul>

            <p>Please keep this email for your reference.</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing our service!</p>
            <p>If you have any questions, please don't hesitate to contact us.</p>
        </div>
    </div>
</body>
</html> 