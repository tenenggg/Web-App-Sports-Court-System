@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>My Booking History</h2>
        </div>
        
    </div>
    <br>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<br>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Venue</th>
                <th>Booking Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Calendar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->venue->name }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td>RM {{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status === 'pending')
                            @if(session('success') && session('booking_id') == $booking->id)
                                <span class="badge badge-info">Payment Completed - Awaiting Approval</span>
                            @else
                                <a href="{{ route('user.payment.checkout', $booking->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-credit-card"></i> Pay RM{{ number_format($booking->total_price, 2) }}
                                </a>
                            @endif
                        @else
                            <span class="badge badge-secondary">Already Paid</span>
                        @endif
                    </td>
                    <td>
                        @if($booking->status === 'approved')
                            <a href="{{ route('user.calendar.add', $booking->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-calendar-plus"></i> Add to Calendar
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($bookings->isEmpty())
    <p>No bookings found</p>
@endif

@endsection
