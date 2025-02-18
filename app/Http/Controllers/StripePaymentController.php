<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentMail;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout($id)
    {
        $booking = Booking::findOrFail($id);
        return view('user.payment.checkout', compact('booking'));
    }

    public function stripePayment($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            // Check if the booking belongs to the authenticated user
            if ($booking->user_id !== auth()->id()) {
                return back()->with('error', 'Unauthorized access');
            }

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'myr',
                        'unit_amount' => (int)($booking->total_price * 100),
                        'product_data' => [
                            'name' => 'Court Booking',
                            'description' => "Booking for {$booking->venue->name} on {$booking->booking_date}",
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('user.payment.success', ['booking_id' => $booking->id]),
                'cancel_url' => route('user.payment.cancel'),
                'metadata' => [
                    'booking_id' => $booking->id
                ]
            ]);

            return response()->json([
                'url' => $session->url
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function success(Request $request)
    {
        try {
            $booking = Booking::findOrFail($request->booking_id);
            
            // Create payment record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'status' => 'paid'
            ]);

            // Update booking status to approved
            $booking->update([
                'status' => 'approved'
            ]);

            // Prepare email data
            $data = [
                'email' => $booking->user->email,
                'booking_id' => $booking->id,
                'booking_date' => $booking->booking_date,
                'start_time' => $booking->start_time,
                'end_time' => $booking->end_time,
                'total_price' => $booking->total_price,
                'status' => 'paid',
            ];

            \Log::info('Attempting to send email', [
                'to' => $booking->user->email,
                'from' => 'mailtrap@courthub.com',
                'data' => $data
            ]);

            try {
                Mail::send('emails.payment_confirmation', $data, function($message) use ($booking) {
                    $message->from('mailtrap@courthub.com', 'CourtHub')
                            ->to($booking->user->email)
                            ->subject('Payment Confirmation');
                });
                
                \Log::info('Email sent successfully');
                
            } catch (\Exception $e) {
                \Log::error('Email sending failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            return redirect()->route('user.bookinghistory.index')
                ->with('success', 'Payment successful! Your booking has been approved.')
                ->with('booking_id', $booking->id);
            
        } catch (\Exception $e) {
            \Log::error('Payment success handling failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('user.bookinghistory.index')
                ->with('error', 'Payment processed but there was an error updating the booking.');
        }
    }

    public function cancel()
    {
        return redirect()->route('user.bookinghistory.index')
            ->with('error', 'Payment was cancelled.');
    }

    public function stripePost(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            
            $charge = $stripe->charges->create([
                "amount" => $request->amount * 100,
                "currency" => "myr",
                "source" => $request->stripeToken,
                "description" => "Payment for booking"
            ]);

            // Create payment record
            $payment = Payment::create([
                'booking_id' => $request->booking_id,
                'amount' => $request->amount,
                'payment_status' => 'completed',
                'transaction_id' => $charge->id,
                // ... any other payment fields ...
            ]);

            // Update the booking status to approved
            $booking = Booking::find($request->booking_id);
            if ($booking) {
                $booking->update([
                    'status' => 'approved'
                ]);
            }

            return redirect()->route('payment.success')->with('success', 'Payment successful!');

        } catch (\Exception $e) {
            return redirect()->route('payment.failed')->with('error', $e->getMessage());
        }
    }
} 