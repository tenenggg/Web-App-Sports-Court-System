@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Payment</h2>
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

    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <input type="hidden" name="id" value="{{ $payment->id }}">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Booking ID:</strong>
                    <input type="text" name="booking_id" value="{{ $payment->booking_id }}" class="form-control" placeholder="Booking ID">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Amount:</strong>
                    <input type="number" step="0.01" name="amount" value="{{ $payment->amount }}" class="form-control" placeholder="Amount">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment Proof (Upload New File):</strong>
                    <input type="file" name="payment_proof" class="form-control">
                    @if($payment->payment_proof)
                        <div class="mt-2">
                            <strong>Current Payment Proof:</strong>
                            <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank">View Proof</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
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
