@extends('layouts.usertemplate')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Cancelled</div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            The payment was cancelled.
                        @endif
                    </div>
                    <a href="{{ route('user.bookinghistory.index') }}" class="btn btn-primary">
                        Return to Booking History
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 