<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('venue')
            ->where('user_id', Auth::id())
            ->get();
        return view('user.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        $venues = Venue::all();
        return view('user.feedbacks.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'venue_id' => 'required',
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'venue_id' => $request->venue_id,
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        return redirect()->route('user.feedbacks.index')
            ->with('success', 'Feedback submitted successfully.');
    }

    public function show(Feedback $feedback)
    {
        if ($feedback->user_id !== Auth::id()) {
            abort(403);
        }
        $feedback->load('venue');
        return view('user.feedbacks.show', compact('feedback'));
    }
} 