@extends('layouts.template')

@section('content')

<div class="row mb-3">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h3>List of Bookings</h3>
        <a class="btn btn-success" href="{{ route('admin.bookings.create') }}">Add New Booking</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($bookings) > 0)
<br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User</th>
                <th>Venue</th>
                <th>Booking Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->venue->name }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td>
                        <span class="badge badge-{{ $booking->status === 'approved' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('admin.bookings.show', $booking->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('admin.bookings.edit', $booking->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No Bookings found</p>
@endif

@endsection
