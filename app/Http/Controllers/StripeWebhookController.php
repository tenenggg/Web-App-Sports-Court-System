<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (SignatureVerificationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                
                // Update booking status only after payment is confirmed
                if ($session->payment_status === 'paid') {
                    // You'll need to add metadata to your session creation
                    // to include the booking_id
                    $booking = Booking::find($session->metadata->booking_id);
                    if ($booking) {
                        $booking->status = 'approved';
                        $booking->save();
                    }
                }
                break;
        }

        return response()->json(['status' => 'success']);
    }
} 