@extends('layouts.usertemplate')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Successful</div>
                <div class="card-body">
                    <div class="alert alert-success">
                        Your payment has been processed successfully!
                    </div>
                    <a href="{{ route('user.bookinghistory.index') }}" class="btn btn-primary">
                        View Booking History
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 