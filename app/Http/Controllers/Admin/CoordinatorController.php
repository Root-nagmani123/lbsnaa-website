<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageCoordinator;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class CoordinatorController extends Controller
{
    public function index()
    {
        $coordinators = ManageCoordinator::all();
        return view('admin.training_master.manage_coordinator.index', compact('coordinators'));
    }

    public function create()
    {
        return view('admin.training_master.manage_coordinator.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_language' => 'required',
            'coordinator_name' => 'required|string|max:255',
            'status' => 'required|string',
        ],
        [
            'page_language.required' => 'Please select language.', // Custom message for language
            'coordinator_name.required' => 'Please enter coodinator name.', // Custom message for organiser name
            'status.required' => 'Please select status.', // Custom message for status
        ]
    );

        $validated['status'] = $request->status === '0' ? 0 : 1;
        $coordinator = ManageCoordinator::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Coordinator Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('coordinators.index')->with('success', 'Coordinator added successfully.');
    }

    public function edit($id)
    {
        $coordinator = ManageCoordinator::findOrFail($id);
        return view('admin.training_master.manage_coordinator.edit', compact('coordinator'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'page_language' => 'required',
            'coordinator_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        
        $validated['status'] = $request->status === '0' ? 0 : 1;
        $coordinator = ManageCoordinator::findOrFail($id);
        $coordinator->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Coordinator Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('coordinators.index')->with('success', 'Coordinator updated successfully.');
    }

    public function destroy($id)
    {
        $coordinator = ManageCoordinator::findOrFail($id);
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($coordinator->status == 1) {
            return redirect()->route('coordinators.index')->with('error', 'Active organisers cannot be deleted.');
        }
        $coordinator->delete();
        return redirect()->route('coordinators.index')->with('success', 'Coordinator deleted successfully.');
    }
}
