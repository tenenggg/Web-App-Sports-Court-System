<?php

// app/Http/Controllers/BookingHistoryController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingHistoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Show all bookings for admin
            $bookings = Booking::with(['user', 'venue'])
                             ->orderBy('created_at', 'desc')
                             ->get();
            return view('admin.bookings.index', compact('bookings'));
        } else {
            // Show only user's bookings
            $bookings = Booking::where('user_id', auth()->id())
                             ->with(['venue'])
                             ->orderBy('created_at', 'desc')
                             ->get();
            return view('user.bookinghistory.index', compact('bookings'));
        }
    }

    public function show(Booking $booking)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.bookings.show', compact('booking'));
        } 
        else {
            if ($booking->user_id !== Auth::id()) {
                abort(403);
            }
            return view('user.bookinghistory.show', compact('booking'));
        }
    }

    // Add method for admin to update booking status
    public function updateStatus(Request $request, Booking $booking)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Booking status updated successfully');
    }
}