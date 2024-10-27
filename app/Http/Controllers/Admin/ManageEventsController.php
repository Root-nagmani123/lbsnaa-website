<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageEvents;
use App\Models\Admin\Course; // Assuming you have a Course model
use Illuminate\Http\Request;

class ManageEventsController extends Controller
{
    // Display a listing of the events
    public function index()
    {
        $events = ManageEvents::all();
        return view('manage_events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        $courses = Course::all(); // Assuming you have courses in the database
        return view('manage_events.create', compact('courses'));
    }

    // Store a newly created event in storage
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'event_title' => 'required|string|max:255',
            'description' => 'required',
            'course_id' => 'required|integer',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required'
        ]);

        ManageEvents::create($request->all());

        return redirect()->route('manage_events.index')
            ->with('success', 'Event created successfully.');
    }

    // Show the form for editing an event
    public function edit($id)
    {
        $event = ManageEvents::findOrFail($id);
        $courses = Course::all();
        return view('manage_events.edit', compact('event', 'courses'));
    }

    // Update the specified event in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required',
            'event_title' => 'required|string|max:255',
            'description' => 'required',
            'course_id' => 'required|integer',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required'
        ]);

        $event = ManageEvents::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('manage_events.index')
            ->with('success', 'Event updated successfully.');
    }

    // Remove the specified event from storage
    public function destroy($id)
    {
        $event = ManageEvents::findOrFail($id);
        $event->delete();

        return redirect()->route('manage_events.index')
            ->with('success', 'Event deleted successfully.');
    }



    public function searchCourses(Request $request)
	{
	    $query = $request->input('query');

	    // Fetch courses that match the search query (you can adjust the filtering logic as needed)
	    $courses = Course::where('name', 'LIKE', "%{$query}%")->get();

	    return response()->json([
	        'courses' => $courses
	    ]);
	}




}
