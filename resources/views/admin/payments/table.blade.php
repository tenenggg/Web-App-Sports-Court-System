@extends('layouts.template')

@section('content')

<div class="row mb-3">
    <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <h3>List of Payments</h3>
        <a class="btn btn-success" href="{{ route('admin.payments.create') }}">Add New Payment</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

@if(count($payments) > 0)
<br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Booking ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->booking_id }}</td>
                    <td>RM {{ number_format($payment->amount, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $payment->status === 'paid' ? 'success' : 'warning' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('admin.payments.show', $payment->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('admin.payments.edit', $payment->id) }}">Edit</a>
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
    <p>No Payments found</p>
@endif

@endsection
