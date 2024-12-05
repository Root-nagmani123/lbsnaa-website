<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ManageOrganiser;
use App\Models\Admin\ManageAudit;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class OrganiserController extends Controller
{
    // Display a listing of organisers
    public function index()
    {
        $organisers = ManageOrganiser::all();
        return view('admin.training_master.manage_organiser.index', compact('organisers'));
    }

    // Show form for creating a new organiser
    public function create()
    {
        return view('admin.training_master.manage_organiser.create');
    }

    // Store a new organiser
    // public function store(Request $request)
    // {
    //     // Validate input data
    //     $request->validate([
    //         'language' => 'required',
    //         'organiser_name' => 'required|string|max:255',
    //         'status' => 'required|string',
    //     ]);

    //     // Prepare validated data for organizer creation
    //     $validated['status'] = $request->status === 'active' ? 1 : 2;
    //     $validatedData = $request->all();
    //     // Create the organizer
    //     $organizer = ManageOrganiser::create($validatedData);

    //     // Log data to the audit table
    //     ManageAudit::create([
    //         'Module_Name' => 'Organiser Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('organisers.index')->with('success', 'Organiser created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate input data with custom error messages
        $request->validate(
            [
                'language' => 'required', // Language must be selected
                'organiser_name' => 'required|string|max:255', // Organizer name must be entered
                'status' => 'required', // Status must be selected
            ],
            [
                'language.required' => 'Please select language.', // Custom message for language
                'organiser_name.required' => 'Please enter organiser name.', // Custom message for organiser name
                'status.required' => 'Please select status.', // Custom message for status
            ]
        );
    
        // Prepare validated data for organizer creation
        $validatedData = $request->all();
        $validatedData['status'] = $request->status === 'active' ? 1 : 0;
    
        // Create the organizer
        $organizer = ManageOrganiser::create($validatedData);
    
        ManageAudit::create([
            'Module_Name' => 'Organiser Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        // Redirect with success message
        return redirect()->route('organisers.index')->with('success', 'Organiser created successfully.');
    }

    


    // Show the form for editing an organiser
    public function edit($id)
    {
        $organiser = ManageOrganiser::findOrFail($id);
        return view('admin.training_master.manage_organiser.edit', compact('organiser'));
    }

    // Update the organiser
    public function update(Request $request, $id)
    {
        // 1. Validate the request data
        $request->validate([
            'language' => 'required',
            'organiser_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);


        $validated['status'] = $request->status === 'active' ? 1 : 0;
        $organiser = ManageOrganiser::findOrFail($id);
        $organiser->update($request->all());

                // Log data to the audit table
        ManageAudit::create([
            'Module_Name' => 'Organiser Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('organisers.index')->with('success', 'Organiser updated successfully.');
    }

    // Delete an organiser
    public function destroy($id)
    {
        $organiser = ManageOrganiser::findOrFail($id);
        $organiser->delete();
        return redirect()->route('organisers.index')->with('success', 'Organiser deleted successfully.');
    }
}
