<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageCadres;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ];
    
        // Custom Error Messages
        $messages = [
            'code.required' => 'Please enter code.',
            'language.required' => 'Please select language.',
            'description.required' => 'Please enter description name.',
            'status.required' => 'Please select status.',
        ];
    
        // Validate Request Data
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }    

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 0;
        $cadres = ManageCadres::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Cadre Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
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
        $rules = [
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ];
    
        // Custom Error Messages
        $messages = [
            'code.required' => 'Please enter code.',
            'language.required' => 'Please select language.',
            'description.required' => 'Please enter description name.',
            'status.required' => 'Please select status.',
        ];
    
        // Validate Request Data
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }    

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 0;
        $cadre = ManageCadres::find($id);
        $cadre->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Cadre Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('cadres.index')->with('success', 'Cadre updated successfully');
    }

    // Delete cadre
    public function destroy($id)
    {
        // Find the cadre by ID
        $cadre = ManageCadres::findOrFail($id);
    
        // Check if the status is 1 (Active), prevent deletion
        if ($cadre->status == 1) {
            Cache::put('error_message', 'Active cadres cannot be deleted.', 1); // Store error in cache
            return redirect()->route('cadres.index')->with('error', 'Active cadres cannot be deleted.');
        }
    
        // Delete the cadre
        $cadre->delete();
    
        // Cache success message
        Cache::put('success_message', 'Cadre deleted successfully.', 1);
    
        return redirect()->route('cadres.index')->with('success', 'Cadre deleted successfully.');
    }

}
