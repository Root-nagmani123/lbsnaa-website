<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageEvents;
use App\Models\Admin\Course; // Assuming you have a Course model
use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageEventsController extends Controller
{
    // Display a listing of the events
    public function index()
    {
        $events = ManageEvents::all();
        return view('admin.manage_events.index', compact('events'));
    }
 
    // Show the form for creating a new event
    public function create()
    {
        $courses = Course::all(); // Assuming you have courses in the database
        return view('admin.manage_events.create', compact('courses'));
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
            'status' => 'required|integer|in:1,2,3',
        ]);

        $event = ManageEvents::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Event Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($event), // Save state as JSON
        ]);

        return redirect()->route('manage_events.index')->with('success', 'Event created successfully.');
    }


    // Assuming you have a Course model that represents the courses table
    public function edit($id)
    {
        $event = ManageEvents::findOrFail($id);

        // Fetch course name based on course_id from the event
        $courseName = null;
        if ($event->course_id) {
            $course = Course::find($event->course_id);
            $courseName = $course ? $course->name : null;
        }

        return view('admin.manage_events.edit', compact('event', 'courseName'));
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
            'status' => 'required|integer|in:1,2,3',
        ]);

        $event = ManageEvents::findOrFail($id);
        $event->update($request->all());

        $event->update([
            'status' => (int) $request['status'], // Explicitly cast to integer
        ]);

        ManageAudit::create([
            'Module_Name' => 'Event Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($event), // Save state as JSON
        ]);

        return redirect()->route('manage_events.index')->with('success', 'Event updated successfully.');
    }

    // Remove the specified event from storage
    public function destroy($id)
    {
        $event = ManageEvents::findOrFail($id);
        $event->delete();

        return redirect()->route('manage_events.index')->with('success', 'Event deleted successfully.');
    }



    public function searchCourses(Request $request)
    {
        $query = $request->query('query');
        $courses = Course::where('name', 'LIKE', '%' . $query . '%')->limit(10)->get(['id', 'name']);
        return response()->json($courses);
    }

    // In app/Http/Controllers/CourseController.php
    public function getCourseDetails($courseId)
    {
        $course = Course::find($courseId); // Fetch course data based on ID

        if ($course) {
            return response()->json([
                'status' => 'success',
                'data' => $course
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Course not found.'
            ], 404);
        }
    }



}
