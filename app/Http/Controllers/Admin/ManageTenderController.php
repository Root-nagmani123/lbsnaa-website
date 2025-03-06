<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageTender;
use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
        // print_r($_FILES);die;
        // Validate the form input
        $rules = [
            'language' => 'required', 
            'type' => 'required|string|max:255',    
            'title' => 'required|string|max:255',   
            'description' => 'required|string',    
            'file' => 'required|mimes:pdf|max:20480', 
            'publish_date' => 'required|date',     
            'expiry_date' => 'required|date|after_or_equal:publish_date', 
            'status' => 'required|integer|in:1,0', 
        ];
    
        $messages = [
            'language.required' => 'Please select language.',
            'type.required' => 'Please specify the type.',
            'title.required' => 'Please enter a title.',
            'description.required' => 'Please provide a description.',
            'file.required' => 'Please upload a file.',
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'File size must not exceed 20 MB.',
            'publish_date.required' => 'Please select a publish date.',
            'expiry_date.required' => 'Please select an expiry date.',
            'expiry_date.after_or_equal' => 'The expiry date must be on or after the publish date.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'The status must be one of the following values: 1, 0.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }       
        $validated = $validator->validated();
        // Handle the file upload
        if ($request->hasFile('file')) {
            $filename = time() . '_file.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(storage_path('app/public/tender/'), $filename);
            $validated['file'] = $filename;
        }
        
        if ($request->hasFile('corrigendum')) {
            $filename_corrigendum = time() . '_corrigendum.' . $request->file('corrigendum')->getClientOriginalExtension();
            $request->file('corrigendum')->move(storage_path('app/public/tender/'), $filename_corrigendum);
            $validated['corrigendum'] = $filename_corrigendum;
        }
        
       
        // Save the tender
        $tender = ManageTender::create([
            'language' => $validated['language'],
            'type' => $validated['type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file' => $filename ?? null,
            'corrigendum' => $filename_corrigendum ?? null,
            'publish_date' => $validated['publish_date'],
            'expiry_date' => $validated['expiry_date'],
            'status' => $validated['status'],
        ]);
        // die;

        // Save the audit record
        ManageAudit::create([
            'Module_Name' => 'Tender Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Tender created successfully!', 1);

        return redirect()->route('manage_tender.index');
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
        $rules = [
            'language' => 'required', 
            'type' => 'required|string|max:255',    
            'title' => 'required|string|max:255',   
            'description' => 'required|string',    
            'file' => 'required|mimes:pdf|max:20480', 
            'publish_date' => 'required|date',     
            'expiry_date' => 'required|date|after_or_equal:publish_date', 
            'status' => 'required|integer|in:1,0', 
        ];
    
        $messages = [
            'language.required' => 'Please select language.',
            'type.required' => 'Please specify the type.',
            'title.required' => 'Please enter a title.',
            'description.required' => 'Please provide a description.',
            'file.required' => 'Please upload a file.',
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'File size must not exceed 20 MB.',
            'publish_date.required' => 'Please select a publish date.',
            'expiry_date.required' => 'Please select an expiry date.',
            'expiry_date.after_or_equal' => 'The expiry date must be on or after the publish date.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'The status must be one of the following values: 1, 0.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }       
    
        // Handle file upload
      // Handle file upload or retain existing file
      if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('tender', 'public');
        $filename = basename($filePath); // Extract only the filename
    } else {
        $filename = $manageTender->file; // Keep the existing filename
    }
    
    if ($request->hasFile('corrigendum')) {
        $corrigendumPath = $request->file('corrigendum')->store('tender', 'public');
        $filename_corrigendum = basename($corrigendumPath); // Extract only the filename
    } else {
        $filename_corrigendum = $manageTender->corrigendum; // Keep the existing filename
    }

     
        // Update the tender record
        $manageTender->update([
            'language' => $request->language,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'corrigendum' => $filename_corrigendum,
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
        Cache::put('success_message', 'Tender updated successfully!', 1);
    
        return redirect()->route('manage_tender.index');
    }
    
    // Delete the tender
    public function destroy(ManageTender $manageTender)
    {
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($manageTender->status == 1) {
        Cache::put('error_message', 'Active tenders cannot be deleted!', 1);

            return redirect()->route('manage_tender.index');
        }

        // Proceed with deletion if status is not inactive
        $manageTender->delete();
        Cache::put('success_message', 'Tender deleted successfully!', 1);

        return redirect()->route('manage_tender.index');
    }

}
