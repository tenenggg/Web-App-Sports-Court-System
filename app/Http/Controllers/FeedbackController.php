<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with(['venue', 'user'])->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $users = User::all();
            $venues = Venue::all();
            return view('admin.feedbacks.create', compact('users', 'venues'));
        } else {
            $users = User::all();
            $venues = Venue::all();
            return view('user.feedbacks.create', compact('users', 'venues'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'venue_id' => 'required|exists:venues,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $user = auth()->user();

        if ($user->isAdmin()) {
            Feedback::create($request->all());
            return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback added successfully.');
        } else {
            Feedback::create($request->all());
            return redirect()->route('user.feedbacks.index')->with('success', 'Feedback added successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.feedbacks.show', compact('feedback'));
        } else {
            return view('user.feedbacks.show', compact('feedback'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();
        $feedback = Feedback::find($id);

        if ($user->isAdmin()) {
            $users = User::all();
            $venues = Venue::all();
            return view('admin.feedbacks.edit', compact('feedback', 'users', 'venues'));
        } else {
            $users = User::all();
            $venues = Venue::all();
            return view('user.feedbacks.edit', compact('feedback', 'users', 'venues'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'venue_id' => 'required|exists:venues,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $user = auth()->user();

        $feedback->update($request->all());

        if ($user->isAdmin()) {
            return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback updated successfully.');
        } else {
            return redirect()->route('user.feedbacks.index')->with('success', 'Feedback updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $user = auth()->user();

        $feedback->delete();

        if ($user->isAdmin()) {
            return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback deleted successfully.');
        } else {
            return redirect()->route('user.feedbacks.index')->with('success', 'Feedback deleted successfully.');
        }
    }
}