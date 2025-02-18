<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::with(['booking.user', 'booking.venue'])
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $bookings = \App\Models\Booking::all();

        if ($user->isAdmin()) {
            return view('admin.payments.create', compact('bookings'));
        } else {
            return view('user.payments.create', compact('bookings'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
            'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:10240',
            'status' => 'required|in:pending,paid,failed',
        ]);

        $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');

        $payment = new Payment();
        $payment->booking_id = $request->booking_id;
        $payment->amount = $request->amount;
        $payment->payment_proof = $filePath;
        $payment->status = $request->status;
        $payment->save();

        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.payments.index')->with('success', 'Payment added successfully');
        } else {
            return redirect()->route('user.payments.index')->with('success', 'Payment added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.payments.show', compact('payment'));
        } else {
            return view('user.payments.show', compact('payment'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $payment = Payment::find($id);
        $bookings = \App\Models\Booking::all();

        if ($user->isAdmin()) {
            return view('admin.payments.edit', compact('payment', 'bookings'));
        } else {
            return view('user.payments.edit', compact('payment', 'bookings'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        
        $request->validate([
            'booking_id' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required',
            'payment_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            if ($payment->payment_proof && file_exists(storage_path('app/public/' . $payment->payment_proof))) {
                unlink(storage_path('app/public/' . $payment->payment_proof));
            }
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $payment->payment_proof = $path;
        }

        $payment->booking_id = $request->booking_id;
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        $payment->save();

        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully');
        } else {
            return redirect()->route('user.payments.index')->with('success', 'Payment updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
        } else {
            return redirect()->route('user.payments.index')->with('success', 'Payment deleted successfully.');
        }
    }

    public function sendEmail($id)
    {
        $user = auth()->user();

        if (!$user->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        try {
            $payment = Payment::with('booking.user')->find($id);
    
            if (!$payment || !$payment->booking || !$payment->booking->user) {
                return redirect()->route('admin.payments.show', $id)
                                 ->with('error', 'Payment, Booking, or User not found.');
            }
    
            $data = [
                'email' => $payment->booking->user->email,
                'booking_id' => $payment->booking->id,
                'booking_date' => $payment->booking->booking_date,
                'start_time' => $payment->booking->start_time,
                'end_time' => $payment->booking->end_time,
                'status' => $payment->status,
            ];
    
            Mail::to($data['email'])->send(new PaymentMail($data));
    
            return redirect()->route('admin.payments.show', $id)
                             ->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            return redirect()->route('admin.payments.show', $id)
                             ->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function createPaymentIntent(Request $request)
    {
        // Set your Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'myr', // Malaysian Ringgit
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('user.payment.success')
            ]);

            return response()->json([
                'success' => true,
                'redirect' => $paymentIntent->next_action ? 
                    $paymentIntent->next_action->redirect_to_url->url : 
                    route('user.payment.success')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function process(Booking $booking)
    {
        // Redirect to Stripe payment
        return redirect()->route('user.payment.stripe', $booking->id);
    }
}