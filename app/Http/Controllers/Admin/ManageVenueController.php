<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageVenue;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ManageVenueController extends Controller
{
    // Show the form for creating a new venue
    public function create()
    {
        return view('admin.training_master.venue.create'); // Adjust the path based on your views
    }
 
    // Store a newly created venue in storage
    public function store(Request $request)
    {
        $rules = [
            'page_language' => 'required',
            'venue_title' => 'required|string',
            'venue_detail' => 'required|string',
            'status' => 'required|string',
        ];
    
        $messages = [
            'page_language.required' => 'Please select language.', 
            'venue_title.required' => 'Please enter title.', 
            'venue_detail.required' => 'Please enter venue details.', 
            'status.required' => 'Please select status.', 
        ];
    
        // Validate Request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }

        $validated['status'] = $request->status === 'active' ? 1 : 0;
        $venue = ManageVenue::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Venue Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Venue added successfully!', 1);
        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    // Display a listing of the venues
    public function index()
    {
        $venues = ManageVenue::all();
        return view('admin.training_master.venue.index', compact('venues'));
    }

    // Show the form for editing the specified venue
    public function edit(ManageVenue $venue)
    {
        return view('admin.training_master.venue.edit', compact('venue'));
    }

    // Update the specified venue in storage
    public function update(Request $request, ManageVenue $venue)
    {
        $rules = [
            'page_language' => 'required',
            'venue_title' => 'required|string',
            'venue_detail' => 'required|string',
            'status' => 'required|string',
        ];
    
        $messages = [
            'page_language.required' => 'Please select language.', 
            'venue_title.required' => 'Please enter title.', 
            'venue_detail.required' => 'Please enter venue details.', 
            'status.required' => 'Please select status.', 
        ];
    
        // Validate Request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }    
        $venue->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Venue Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Venue updated successfully!', 1);

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }


public function destroy($id)
{
    // Find the venue by ID
    $venue = ManageVenue::findOrFail($id);

    // ❌ Prevent deletion if status = 1 (Active)
    if ($venue->status == 1) {
        // **Cache the error message for 1 minute**
        Cache::put('error_message', 'Active venues cannot be deleted.', 1);
        
        // **Redirect with error message**
        return redirect()->route('venues.index')->with('error', 'Active venues cannot be deleted.');
    }

    // ✅ Delete the venue if status ≠ 1
    $venue->delete();

    // **Cache success message for 1 minute**
    Cache::put('success_message', 'Venue deleted successfully.', 1);

    // **Redirect with success message**
    return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
}



}
