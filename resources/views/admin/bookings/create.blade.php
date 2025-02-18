@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Booking</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('admin.bookings.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="user_id">User</label>
        <select name="user_id" class="form-control">
            <option value="">-- Select User --</option>
            @foreach ($users as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="venue_id">Venue</label>
        <select name="venue_id" class="form-control">
            <option value="">-- Select Venue --</option>
            @foreach ($venues as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="booking_date">Booking Date</label>
        <input type="date" class="form-control" name="booking_date" placeholder="Booking Date">
    </div>

    <div class="form-group">
        <label for="start_time">Start Time</label>
        <input type="time" class="form-control" name="start_time" placeholder="Start Time">
    </div>

    <div class="form-group">
        <label for="end_time">End Time</label>
        <input type="time" class="form-control" name="end_time" placeholder="End Time">
    </div>


    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="approved">Approved</option>
            <option value="cancelled">Cancelled</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="{{ route('admin.bookings.index') }}"> Back</a>
    </div>
</form>
@endsection
