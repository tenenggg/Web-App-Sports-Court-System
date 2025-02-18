@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Booking</h2>
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

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" name="id" value="{{ $booking->id }}"> <br/>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>User:</strong>
                    <select name="user_id" class="form-control">
                        <option value="">-- Select User --</option>
                        @foreach ($users as $id => $name)
                            <option value="{{ $id }}" {{ $booking->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Venue:</strong>
                    <select name="venue_id" class="form-control">
                        <option value="">-- Select Venue --</option>
                        @foreach ($venues as $id => $name)
                            <option value="{{ $id }}" {{ $booking->venue_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Booking Date:</strong>
                    <input type="date" name="booking_date" value="{{ $booking->booking_date }}" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start Time:</strong>
                    <input type="time" name="start_time" value="{{ $booking->start_time }}" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>End Time:</strong>
                    <input type="time" name="end_time" value="{{ $booking->end_time }}" class="form-control">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
            </div>

           

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('admin.bookings.index') }}"> Back</a>
            </div>
        </div>
    </form>
@endsection
