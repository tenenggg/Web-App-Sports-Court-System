<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookcourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        } 
        else {
            $venues = Venue::all();
            return view('user.bookcourts.index', compact('venues'));
        }
    }

    public function create(Request $request)
    {
        $venue = Venue::findOrFail($request->venue_id);
        return view('user.bookcourts.create', compact('venue'));
    }

    public function checkout(Request $request, $id)
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            abort(403, 'Unauthorized action.');
        } else {
            $venue = Venue::findOrFail($id);

            if ($request->isMethod('post')) {
                $validated = $request->validate([
                    'booking_date' => 'required|date',
                    'start_time' => 'required',
                    'end_time' => 'required|after:start_time',
                    'total_price' => 'required|numeric'
                ]);

                // Check for existing approved bookings at the same time
                $existingBooking = Booking::where('venue_id', $id)
                    ->where('booking_date', $validated['booking_date'])
                    ->where('status', 'approved')
                    ->where(function ($query) use ($validated) {
                        $query->where(function ($q) use ($validated) {
                            // Check if start time falls within existing booking
                            $q->where('start_time', '<=', $validated['start_time'])
                              ->where('end_time', '>', $validated['start_time']);
                        })->orWhere(function ($q) use ($validated) {
                            // Check if end time falls within existing booking
                            $q->where('start_time', '<', $validated['end_time'])
                              ->where('end_time', '>=', $validated['end_time']);
                        });
                    })
                    ->first();

                if ($existingBooking) {
                    return back()->with('error', 'This venue is already booked for the selected time slot.');
                }

                // Create the booking if no conflicts
                $booking = Booking::create([
                    'user_id' => auth()->id(),
                    'venue_id' => $id,
                    'booking_date' => $validated['booking_date'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'total_price' => $validated['total_price'],
                    'status' => 'pending'
                ]);

                return redirect()->route('user.bookinghistory.index')
                    ->with('success', 'Booking confirmed!');
            }

            return view('user.bookcourts.checkout', compact('venue'));
        }
    }

    public function checkAvailability($venue_id, $date)
    {
        try {
            $bookedSlots = Booking::where('venue_id', $venue_id)
                ->where('booking_date', $date)
                ->where('status', 'approved')
                ->get(['start_time', 'end_time'])
                ->map(function ($booking) {
                    // Convert times to 24-hour format for consistency
                    $start = date('H:i', strtotime($booking->start_time));
                    $end = date('H:i', strtotime($booking->end_time));
                    return [
                        'start_time' => $start,
                        'end_time' => $end
                    ];
                });

            return response()->json($bookedSlots);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}