<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin sees all bookings
            $bookings = Booking::with(['user', 'venue'])
                              ->orderBy('created_at', 'desc')
                              ->get();
            return view('admin.bookings.index', compact('bookings'));
        } else {
            // Admin sees all bookings
            $bookings = Booking::where('user_id', auth()->id())
                              ->with('venue')
                              ->orderBy('created_at', 'desc')
                              ->get();
            return view('user.bookings.index', compact('bookings'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin can create bookings for any user
            $users = User::pluck('name', 'id');
            $venues = Venue::pluck('name', 'id');
            return view('admin.bookings.create', compact('users', 'venues'));
        } else {
            // User can create their own booking
            $users = User::pluck('name', 'id');
            $venues = Venue::pluck('name', 'id');
            return view('user.bookings.create', compact('users', 'venues'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'venue_id' => 'required',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Get the venue to calculate price
        $venue = Venue::findOrFail($request->venue_id);

        // Calculate total price
        $start = strtotime($request->start_time);
        $end = strtotime($request->end_time);
        $hours = ($end - $start) / 3600; // Convert seconds to hours
        $totalPrice = $hours * $venue->price_per_hour;

        // Create booking with calculated price
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'venue_id' => $request->venue_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.bookings.show', compact('booking'));

        } else {
            return view('user.bookings.show', compact('booking'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $user = auth()->user();

    
        if ($user->isAdmin()) {
            $users = User::pluck('name', 'id');
            $venues = Venue::pluck('name', 'id');
            return view('admin.bookings.edit', compact('booking', 'users', 'venues'));

        } else {
            $users = User::pluck('name', 'id');
            $venues = Venue::pluck('name', 'id');
            return view('user.bookings.edit', compact('booking', 'users', 'venues'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required',
            'venue_id' => 'required',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Get the venue to calculate price
        $venue = Venue::findOrFail($request->venue_id);

        // Calculate total price
        $start = strtotime($request->start_time);
        $end = strtotime($request->end_time);
        $hours = ($end - $start) / 3600; // Convert seconds to hours
        $totalPrice = $hours * $venue->price_per_hour;

        // Update booking with calculated price
        $booking->update([
            'user_id' => $request->user_id,
            'venue_id' => $request->venue_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice,
            'status' => $request->status ?? $booking->status
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $user = auth()->user();

        if ($user->isAdmin() ) {
            // Admin or the user who owns the booking can delete it
            $booking->delete();
            return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
        }

        else {
            $booking->delete();
            return redirect()->route('user.bookings.index')->with('success', 'Booking deleted successfully.');
        }

        
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,cancelled'
        ]);

        // Update booking status
        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Booking status updated successfully');
    }
}
