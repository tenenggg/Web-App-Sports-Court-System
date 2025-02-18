@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Payment Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User ID:</strong>
                {{ $payment->booking->user->id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Booking ID:</strong>
                {{ $payment->booking_id }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Booking Date:</strong>
                {{ $payment->booking->booking_date }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start Time:</strong>
                {{ $payment->booking->start_time }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Time:</strong>
                {{ $payment->booking->end_time }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payment Date:</strong>
                {{ $payment->created_at->format('Y-m-d H:i:s') }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount:</strong>
                RM {{ number_format($payment->amount, 2) }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ ucfirst($payment->status) }}
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.payments.index') }}" class="btn btn-primary">Back</a>
            <a href="{{ route('admin.payments.sendEmail', $payment->id) }}" class="btn btn-primary">Send Email</a>
        </div>
    </div>
@endsection
