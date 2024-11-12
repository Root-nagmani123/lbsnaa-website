<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageCadres;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageCadresController extends Controller
{
    // Display the list of cadres
    public function index()
    {
        $cadres = ManageCadres::all();
        return view('admin.training_master.cadres.index', compact('cadres'));
    }

    // Show form for creating new cadre
    public function create()
    {
        return view('admin.training_master.cadres.create');
    }

    // Store new cadre
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ]);

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $cadres = ManageCadres::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Cadre Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($cadres), // Save state as JSON
        ]);

        return redirect()->route('cadres.index')->with('success', 'Cadre added successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $cadre = ManageCadres::find($id);
        return view('admin.training_master.cadres.edit', compact('cadre'));
    }

    // Update cadre details
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ]);

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $cadre = ManageCadres::find($id);
        $cadre->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Cadre Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($cadre), // Save state as JSON
        ]);

        return redirect()->route('cadres.index')->with('success', 'Cadre updated successfully');
    }

    // Delete cadre
    public function destroy($id)
    {
        ManageCadres::destroy($id);
        return redirect()->route('cadres.index')->with('success', 'Cadre deleted successfully');
    }
}
