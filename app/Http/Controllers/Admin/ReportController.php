<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\User;
use App\Models\Venue;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Feedback;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function bookings(Request $request)
    {
        $request->validate([
            'report_date' => 'required|date'
        ]);

        $date = $request->report_date;
        
        // Get bookings grouped by venue
        $venues = Venue::with(['bookings' => function($query) use ($date) {
            $query->whereDate('booking_date', $date)
                  ->with('user');
        }])->get();

        $pdf = PDF::loadView('admin.reports.bookings', [
            'venues' => $venues,
            'date' => $date
        ]);

        return $pdf->download('bookings-report-' . $date . '.pdf');
    }

    public function full(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $data = [];
        $sections = $request->sections;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if (in_array('users', $sections)) {
            $data['users'] = User::where('role', 'user')->get();
        }

        if (in_array('venues', $sections)) {
            $data['venues'] = Venue::all();
        }

        if (in_array('bookings', $sections)) {
            $query = Booking::with(['user', 'venue']);
            if ($startDate && $endDate) {
                $query->whereBetween('booking_date', [$startDate, $endDate]);
            }
            $data['bookings'] = $query->get();
        }

        if (in_array('payments', $sections)) {
            $query = Payment::with(['booking.user']);
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            $data['payments'] = $query->get();
        }

        if (in_array('revenue', $sections)) {
            if ($startDate && $endDate) {
                $data['revenue'] = Payment::whereBetween('created_at', [$startDate, $endDate])
                    ->selectRaw('DATE(created_at) as date, SUM(amount)/100 as total')
                    ->groupBy('date')
                    ->get();
            } else {
                $data['revenue'] = Payment::selectRaw('DATE(created_at) as date, SUM(amount)/100 as total')
                    ->groupBy('date')
                    ->get();
            }
        }

        if (in_array('feedback', $sections)) {
            $query = Feedback::with('user');
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            $data['feedback'] = $query->get();
        }

        $pdf = PDF::loadView('admin.reports.full', [
            'data' => $data,
            'sections' => $sections,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

        return $pdf->download('full-report.pdf');
    }
} 