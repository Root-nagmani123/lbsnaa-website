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

    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'language' => 'required', // Ensure language is entered
            'type' => 'required|string|max:255',    // Ensure type is entered
            'title' => 'required|string|max:255',   // Ensure title is entered
            'description' => 'required|string',    // Ensure description is entered
            'file' => 'required|mimes:pdf|max:20480', // Allow only PDFs with a maximum size of 20 MB
            'publish_date' => 'required|date',     // Ensure publish_date is a valid date
            'expiry_date' => 'required|date|after_or_equal:publish_date', // expiry_date must be after or on publish_date
            'status' => 'required|integer|in:1,0', // Ensure status is one of the valid options
        ], [
            // Custom error messages
            'language.required' => 'Please select language.',
            'type.required' => 'Please specify the type.',
            'title.required' => 'Please enter a title.',
            'description.required' => 'Please provide a description.',
            'file.required' => 'Please upload a file.',
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'File size must not exceed 20 MB.',
            'publish_date.required' => 'Please select a publish date.',
            'expiry_date.required' => 'Please select a expiry date.',
            'expiry_date.after_or_equal' => 'The expiry date must be on or after the publish date.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'The status must be one of the following values: 1, 0.',
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
	        $filename = time() . '.' . $request->file->extension();
	        $request->file->move(storage_path('app/public/tender/'), $filename);
	        $validated['file'] = $filename;
	    }

        // Save the tender
        $tender = ManageTender::create([
            'language' => $validated['language'],
            'type' => $validated['type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file' => $filename ?? null,
            'publish_date' => $validated['publish_date'],
            'expiry_date' => $validated['expiry_date'],
            'status' => $validated['status'],
        ]);

        // Save the audit record
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
        // Validate the input
        $request->validate([
            'language' => 'required',
            'type' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|mimes:pdf|max:20480', // Allow only PDFs with a maximum size of 20 MB
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,0',
        ]);
    
        // Handle file upload
        if ($request->hasFile('file')) {
            $filename = $request->file->store('tender', 'public');
        } else {
            // Keep the existing file if no new file is uploaded
            $filename = $manageTender->file;
        }
    
        // Update the tender record
        $manageTender->update([
            'language' => $request->language,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'publish_date' => $request->publish_date,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);
    
        // Add audit log entry
        ManageAudit::create([
            'Module_Name' => 'Tender Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // Authenticated user ID
            'Updated_By' => null, // Authenticated user ID
            'Action_Type' => 'Update', // Action type
            'IP_Address' => $request->ip(), // Get IP address
        ]);
    
        return redirect()->route('manage_tender.index')->with('success', 'Tender updated successfully.');
    }
    
    // Delete the tender
    public function destroy(ManageTender $manageTender)
    {
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($manageTender->status == 1) {
            return redirect()->route('manage_tender.index')->with('error', 'Inactive tenders cannot be deleted.');
        }

        // Proceed with deletion if status is not inactive
        $manageTender->delete();
        return redirect()->route('manage_tender.index')->with('success', 'Tender deleted successfully.');
    }

}
