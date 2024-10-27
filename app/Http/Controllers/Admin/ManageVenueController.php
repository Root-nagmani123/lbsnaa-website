<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageVenue;
use Illuminate\Http\Request;

class ManageVenueController extends Controller
{
    // Show the form for creating a new venue
    public function create()
    {
        return view('training_master.venue.create'); // Adjust the path based on your views
    }

    // Store a newly created venue in storage
    public function store(Request $request)
    {
        $request->validate([
            'page_language' => 'required|string',
            'venue_title' => 'required|string',
            'venue_detail' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        ManageVenue::create($request->all());

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    // Display a listing of the venues
    public function index()
    {
        $venues = ManageVenue::all();
        return view('training_master.venue.index', compact('venues'));
    }

    // Show the form for editing the specified venue
    public function edit(ManageVenue $venue)
    {
        return view('training_master.venue.edit', compact('venue'));
    }

    // Update the specified venue in storage
    public function update(Request $request, ManageVenue $venue)
    {
        $request->validate([
            'page_language' => 'required|string',
            'venue_title' => 'required|string',
            'venue_detail' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $venue->update($request->all());

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    // Remove the specified venue from storage
    public function destroy(ManageVenue $venue)
    {
        $venue->delete();
        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
    }
}
