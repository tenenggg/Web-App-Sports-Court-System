@extends('layouts.usertemplate')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Booking History Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Venue:</strong>
                {{ $bookinghistory->name ?? 'N/A' }} <!-- Display the venue's name -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Booking Date:</strong>
                {{ $bookinghistory->booking_date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start Time:</strong>
                {{ $bookinghistory->start_time }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Time:</strong>
                {{ $bookinghistory->end_time }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Total Price:</strong>
                {{ $bookinghistory->total_price }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ ucfirst($bookinghistory->status) }} <!-- Capitalize the first letter -->
            </div>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.bookings.index') }}"> Back</a>
        </div>
    </div>
@endsection
