<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageTender;
use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageTenderController extends Controller
{
    // Show all tenders/circulars
    public function index()
    {
        $tenders = ManageTender::all();
        return view('admin.manage_tender.index', compact('tenders'));
    }

    // Show form for creating a new tender
    public function create()
    {
        return view('admin.manage_tender.create');
    }

    // Store the newly created tender
    public function store(Request $request)
    {
        // Validate the form
        // $request->validate([
	    //     'txtlanguage' => 'required',
	    //     'type' => 'required',
	    //     'title' => 'required|string|max:255',
	    //     'description' => 'required|string',
	    //     'file' => 'required|mimes:pdf,png,jpg|max:2048',
	    //     'publish_date' => 'required|date',
	    //     'expiry_date' => 'required|date|after_or_equal:publish_date',
	    //     'status' => 'required|integer|in:1,2,3',
	    // ]);


        if ($request->hasFile('file')) {
	        $filename = time() . '.' . $request->file->extension();
	        $request->file->move(storage_path('app/public/uploads'), $filename);
	        $validated['file'] = $filename;
	    }

        // Save the tender
        $tender = ManageTender::create([
            'language' => $request->txtlanguage,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'publish_date' => $request->publish_date,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'Tender Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            
        ]);

        return redirect()->route('manage_tender.index')->with('success', 'Tender created successfully.');
    }

    // Show a specific tender
    public function show(ManageTender $manageTender)
    {
        return view('manage_tender.show', compact('manageTender'));
    }

    // Show form to edit a specific tender
    public function edit(ManageTender $manageTender)
    {
        return view('admin.manage_tender.edit', compact('manageTender'));
    }

    // Update the tender
    public function update(Request $request, ManageTender $manageTender)
    {
        $request->validate([
	        'txtlanguage' => 'required',
	        'type' => 'required',
	        'title' => 'required|string|max:255',
	        'description' => 'required|string',
	        'file' => 'nullable|mimes:pdf,png,jpg|max:2048',
	        'publish_date' => 'required|date',
	        'expiry_date' => 'required|date|after_or_equal:publish_date',
	        'status' => 'required|integer|in:1,2,3',
	    ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filename = $request->file->store('uploads', 'public');
        } else {
            $filename = $manageTender->file;
        }

        // Update the tender
        
        $manageTender->update([
            'language' => $request->txtlanguage,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'publish_date' => $request->publish_date,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);


        ManageAudit::create([
            'Module_Name' => 'Tender Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($manageTender), // Save state as JSON
        ]);

        return redirect()->route('manage_tender.index')->with('success', 'Tender updated successfully.');
    }

    // Delete the tender
    public function destroy(ManageTender $manageTender)
    {
        $manageTender->delete();
        return redirect()->route('manage_tender.index')->with('success', 'Tender deleted successfully.');
    }
}
