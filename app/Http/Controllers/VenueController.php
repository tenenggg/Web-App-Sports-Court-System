<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        if (auth()->user()->isAdmin) {
            return view('admin.venues.index', compact('venues'));
        } else {
            return view('user.venues.index', compact('venues'));
        }
    }

    public function create()
    {
        if (auth()->user()->isAdmin) {
            return view('admin.venues.create');
        } else {
            return view('user.venues.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price_per_hour' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('venues', 'public');
            $data['image'] = $path;
        }

        Venue::create($data);

        return redirect()->route('admin.venues.index')
                     ->with('success','Venue created successfully.');
    }

    public function show(Venue $venue)
    {
        if (auth()->user()->isAdmin) {
            return view('admin.venues.show', compact('venue'));
        } else {
            return view('user.venues.show', compact('venue'));
        }
    }

    public function edit(Venue $venue)
    {
        if (auth()->user()->isAdmin) {
            return view('admin.venues.edit', compact('venue'));
        } else {
            return view('user.venues.edit', compact('venue'));
        }
    }

    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price_per_hour' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($venue->image) {
                Storage::disk('public')->delete($venue->image);
            }
            
            $image = $request->file('image');
            $path = $image->store('venues', 'public');
            $data['image'] = $path;
        }

        $venue->update($data);

        return redirect()->route('admin.venues.index')
                     ->with('success','Venue updated successfully');
    }

    public function destroy(Venue $venue)
    {
        if ($venue->image) {
            Storage::disk('public')->delete($venue->image);
        }
        
        $venue->delete();
        return redirect()->route('admin.venues.index')
                     ->with('success','Venue deleted successfully');
    }
}