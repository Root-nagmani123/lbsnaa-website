<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class ManageResearchCentreController extends Controller
{
    public function researchcentresIndex()
    {
        $researchCentres = DB::table('research_centres')->get();
        return view('admin.micro.manage_researchcentre.index', compact('researchCentres'));
    }

    public function researchcentresCreate()
    {
        return view('admin.micro.manage_researchcentre.create');
    }

    // public function researchcentresStore(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'language' => 'required|in:1,2',
    //         'research_centre_name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'status' => 'required|boolean',
    //     ]);
    //     // dd($validatedData);
    //     DB::table('research_centres')->insert([
    //         'language' => $validatedData['language'],
    //         'research_centre_name' => $validatedData['research_centre_name'],
    //         'sub_heading' => 'sub_heading',
    //         'home_title' => 'home_title',
    //         'pdf' => 'pdfUpload',
    //         'url' => 'websiteUrl',
    //         'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
    //         'description' => $validatedData['description'],
    //         'status' => $validatedData['status'],
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     MicroManageAudit::create([
    //         'Module_Name' => 'Research Center', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('researchcentres.index')->with('success', 'Research Centre added successfully!');
    // }

    public function researchcentresStore(Request $request)
    {
        // Validate input fields
        $rules = [
            'language' => 'required|in:1,2',
            'research_centre_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'texttype' => 'nullable|in:1,2', 
            'pdfUpload' => 'nullable|file|mimes:pdf|max:2048', 
            'websiteUrl' => 'nullable|url|max:255',
        ];
        
        $messages = [
            'language.required' => 'Language selection is required.',
            'language.in' => 'Invalid language selection.',
            'research_centre_name.required' => 'Research Centre Name is required.',
            'research_centre_name.string' => 'Research Centre Name must be a valid string.',
            'research_centre_name.max' => 'Research Centre Name must not exceed 255 characters.',
            'description.required' => 'Description is required.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Status must be either 1 (Active) or 0 (Inactive).',
            'texttype.in' => 'Invalid text type selection.',
            'pdfUpload.mimes' => 'Only PDF files are allowed.',
            'pdfUpload.max' => 'PDF file size must not exceed 2MB.',
            'websiteUrl.url' => 'Enter a valid website URL.',
            'websiteUrl.max' => 'Website URL must not exceed 255 characters.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

        // Initialize PDF and URL variables
        $pdf = null;
        $url = null;

        // Handle file upload if texttype is 1 (PDF)
        if ($validatedData['texttype'] == 1) {
            if ($request->hasFile('pdfUpload')) {
                $pdf = $request->file('pdfUpload')->store('uploads/research_pdfs', 'public'); // Store in public/uploads/research_pdfs
            }
        } elseif ($validatedData['texttype'] == 2) {
            $url = $validatedData['websiteUrl']; // Assign URL directly
        }

        // Insert into the database
        DB::table('research_centres')->insert([
            'language' => $validatedData['language'],
            'research_centre_name' => $validatedData['research_centre_name'],
            'sub_heading' => 'sub_heading',
            'home_title' => 'home_title',
            'texttype' => $validatedData['texttype'],
            'pdf' => $pdf,
            'url' => $url,
            'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Audit log
        MicroManageAudit::create([
            'Module_Name' => 'Research Center',
            'Time_Stamp' => time(),
            'Created_By' => null, // Use the authenticated user ID
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        // Redirect with success message
        return redirect()->route('researchcentres.index')->with('success', 'Research Centre added successfully!');
    }


    public function researchcentresEdit($id)
    {
        $researchCentre = DB::table('research_centres')->where('id', $id)->first();
        return view('admin.micro.manage_researchcentre.edit', compact('researchCentre'));
    }

    // public function researchcentresUpdate(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'language' => 'required|in:1,2',
    //         'research_centre_name' => 'required|string|max:255',
    //         'sub_heading' => 'nullable|string',
    //         'home_title' => 'required|string',
    //         'description' => 'nullable|string',
    //         'status' => 'required|boolean',

    //         'texttype' => 'nullable|in:1,2', // Ensure texttype is present and valid
    //         'pdfUpload' => 'nullable|file|mimes:pdf|max:2048', // Validate PDF file
    //         'websiteUrl' => 'nullable|url|max:255', // Validate URL
    //     ]); 
        
        
    //     // Initialize PDF and URL variables
    //     $pdf = null;
    //     $url = null;

    //     // Handle file upload if texttype is 1 (PDF)
    //     if ($validatedData['texttype'] == 1) {
    //         if ($request->hasFile('pdfUpload')) {
    //             $pdf = $request->file('pdfUpload')->store('uploads/research_pdfs', 'public'); // Store in public/uploads/research_pdfs
    //         }
    //     } elseif ($validatedData['texttype'] == 2) {
    //         $url = $validatedData['websiteUrl']; // Assign URL directly
    //     }


    //     DB::table('research_centres')->where('id', $id)->update([
    //         'language' => $validatedData['language'],
    //         'research_centre_name' => $validatedData['research_centre_name'],
    //         'sub_heading' => $validatedData['sub_heading'],
    //         'home_title' => $validatedData['home_title'],
    //         'texttype' => $validatedData['texttype'],
    //         'pdf' => $pdf,
    //         'url' => $url,

    //         'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
    //         'description' => $validatedData['description'],
    //         'status' => $validatedData['status'],
    //         'updated_at' => now(),
    //     ]);

    //     MicroManageAudit::create([
    //         'Module_Name' => 'Research Center', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('researchcentres.index')->with('success', 'Research Centre updated successfully!');
    // }

    public function researchcentresUpdate(Request $request, $id)
    {
        $rules = [
            'language' => 'required|in:1,2',
            'research_centre_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'texttype' => 'nullable|in:1,2', 
            'pdfUpload' => 'nullable|file|mimes:pdf|max:2048', 
            'websiteUrl' => 'nullable|url|max:255',
            'sub_heading' => 'nullable|string',
            'home_title' => 'nullable|string',
        ];
        
        $messages = [
            'language.required' => 'Language selection is required.',
            'language.in' => 'Invalid language selection.',
            'research_centre_name.required' => 'Research Centre Name is required.',
            'research_centre_name.string' => 'Research Centre Name must be a valid string.',
            'research_centre_name.max' => 'Research Centre Name must not exceed 255 characters.',
            'description.required' => 'Description is required.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Status must be either 1 (Active) or 0 (Inactive).',
            'texttype.in' => 'Invalid text type selection.',
            'pdfUpload.mimes' => 'Only PDF files are allowed.',
            'pdfUpload.max' => 'PDF file size must not exceed 2MB.',
            'websiteUrl.url' => 'Enter a valid website URL.',
            'websiteUrl.max' => 'Website URL must not exceed 255 characters.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

        // Retrieve existing record
        $existingData = DB::table('research_centres')->where('id', $id)->first();

        // Retain existing values if no new input is provided
        $pdf = $existingData->pdf; // Default to existing PDF
        $url = $existingData->url; // Default to existing URL

        // Update PDF if a new file is uploaded
        if ($validatedData['texttype'] == 1 && $request->hasFile('pdfUpload')) {
            $pdf = $request->file('pdfUpload')->store('uploads/research_pdfs', 'public');
            $url = null; // Clear URL if a PDF is uploaded
        }

        // Update URL if a new URL is provided
        if ($validatedData['texttype'] == 2 && $validatedData['websiteUrl']) {
            $url = $validatedData['websiteUrl'];
            $pdf = null; // Clear PDF if a URL is provided
        }

        // Update the database
        DB::table('research_centres')->where('id', $id)->update([
            'language' => $validatedData['language'],
            'research_centre_name' => $validatedData['research_centre_name'],
            'sub_heading' => $validatedData['sub_heading'],
            'home_title' => $validatedData['home_title'],
            'texttype' => $validatedData['texttype'],
            'pdf' => $pdf,
            'url' => $url,
            'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'updated_at' => now(),
        ]);

        // Log the update action
        MicroManageAudit::create([
            'Module_Name' => 'Research Center',
            'Time_Stamp' => time(),
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // Use authenticated user ID for updates
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('researchcentres.index')->with('success', 'Research Centre updated successfully!');
    }

 
    
    public function researchcentresDestroy($id)
    {
        // Fetch the research center by ID
        $researchCentre = DB::table('research_centres')->where('id', $id)->first();

        // Check if the record exists
        if (!$researchCentre) {
            return redirect()->route('researchcentres.index')->with('error', 'Research Centre not found.');
        }

        // Check if the status is 1 (Inactive)
        if ($researchCentre->status == 1) {
            return redirect()->route('researchcentres.index')->with('error', 'Active Research Centres cannot be deleted.');
        }

        // Proceed with deletion
        DB::table('research_centres')->where('id', $id)->delete();

        return redirect()->route('researchcentres.index')->with('success', 'Research Centre deleted successfully!');
    }


}
