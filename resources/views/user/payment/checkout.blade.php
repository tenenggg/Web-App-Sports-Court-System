@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>
                <div class="card-body">
                    <h4>Booking Details</h4>
                    <p>Venue: {{ $booking->venue->name }}</p>
                    <p>Date: {{ $booking->booking_date }}</p>
                    <p>Time: {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                    <p>Total Amount: RM {{ number_format($booking->total_price, 2) }}</p>

                    <form id="payment-form" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="checkout-button">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ env('STRIPE_KEY') }}');
const checkoutButton = document.getElementById('checkout-button');

checkoutButton.addEventListener('click', function(e) {
    e.preventDefault();
    
    fetch('{{ route('user.payment.stripe', $booking->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(session => {
        if (session.url) {
            window.location.href = session.url;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
</script>
@endsection 