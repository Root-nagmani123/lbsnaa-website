<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageFounders;
use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageFoundersController extends Controller
{
    // Display the list of founders
    public function index()
    {
        $founders = ManageFounders::all();
        return view('admin.training_master.founders.index', compact('founders'));
    }

    // Show the form to create a new founder
    public function create()
    {
        return view('admin.training_master.founders.create');
    }

    // Store the new founder in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'language' => 'required',
            'status' => 'required|string',
        ],
        [
            'language.required' => 'Please select language.', // Custom message for language
            'name.required' => 'Please enter founders name.', // Custom message for organiser name
            'status.required' => 'Please select status.', // Custom message for status
        ]    
    );

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $founder = ManageFounders::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Founders Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($founder), // Save state as JSON
        ]);

        return redirect()->route('founders.index')->with('success', 'Founder added successfully.');
    }

    // Show the form to edit an existing founder
    public function edit($id)
    {
        $founder = ManageFounders::findOrFail($id);
        return view('admin.training_master.founders.edit', compact('founder'));
    }

    // Update the founder's details
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'language' => 'required',
            'status' => 'required|string',
        ]);

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $founder = ManageFounders::findOrFail($id);
        $founder->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Founders Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($founder), // Save state as JSON
        ]);

        return redirect()->route('founders.index')->with('success', 'Founder updated successfully.');
    }

    // Delete a founder from the database
    public function destroy($id)
    {
        $founder = ManageFounders::findOrFail($id);
        $founder->delete();
        return redirect()->route('founders.index')->with('success', 'Founder deleted successfully.');
    }
}
