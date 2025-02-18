<!DOCTYPE html>
<html>
<head>
    <title>Bookings Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .venue { margin-bottom: 30px; }
        .venue-name { 
            background: #1a56db; 
            color: white;  
            padding: 10px;
            margin-bottom: 10px;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bookings Report</h1>
        <h2>Date: {{ date('d M Y', strtotime($date)) }}</h2>
    </div>

    @foreach($venues as $venue)
    <div class="venue">
        <h3 class="venue-name">{{ $venue->name }}</h3>
        @if($venue->bookings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venue->bookings as $booking)
                <tr>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No bookings for this venue on the selected date.</p>
        @endif
    </div>
    @endforeach
</body>
</html> 