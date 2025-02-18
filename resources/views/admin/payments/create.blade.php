@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create Payment</h2>
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

    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Booking ID -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Booking ID:</strong>
                    <select name="booking_id" class="form-control" required>
                        <option value="">Select Booking</option>
                        @foreach ($bookings as $booking)
                            <option value="{{ $booking->id }}">{{ $booking->id }} - {{ $booking->user->name }} ({{ $booking->venue->name }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Amount -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Amount:</strong>
                    <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount" required>
                </div>
            </div>

            <!-- Payment Proof -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment Proof (Upload File):</strong>
                    <input type="file" name="payment_proof" class="form-control" required>
                </div>
            </div>

            <!-- Status -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('admin.payments.index') }}">Back</a>
            </div>
        </div>

    </form>
@endsection
