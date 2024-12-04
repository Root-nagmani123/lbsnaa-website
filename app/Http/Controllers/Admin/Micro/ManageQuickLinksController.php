<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageQuickLinksController extends Controller
{
    public function quick_link_list()
    {
        $quick_links = DB::table('micro_quick_links')->get();
        return view('admin.micro.quick_links.index', compact('quick_links'));
    }

    // Category create method to show the create form
    public function quick_link_create()
    {
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        
        return view('admin.micro.quick_links.create',compact('researchCentres'));
    }

    // Category store method to handle form submission for creating new section
    public function quick_link_store(Request $request)
    {// Validate the input
        $validatedData = $request->validate([
            'research_centre_id' => 'required|integer',
            'language' => 'required|in:1,2',
            'category_type' => 'required|in:1,2',
            'name' => 'required|string|max:255',
            'menu_type' => 'required|in:1,2,3',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
            'website_url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'termination_date' => 'nullable|date',
            'status' => 'required|in:1,0',
        ]);

        // Handle file upload if present
        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('uploads', 'public');
        }


        // Prepare data for insertion
        $data = [
            'research_centre_id' => $validatedData['research_centre_id'],
            'language' => $validatedData['language'],
            'categorytype' => $validatedData['category_type'],
            'txtename' => $validatedData['name'],
            'menu_type' => $validatedData['menu_type'],
            'meta_title' => $validatedData['meta_title'] ?? null,
            'meta_keyword' => $validatedData['meta_keyword'] ?? null,
            'meta_description' => $validatedData['meta_description'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'pdf_file' => $pdfPath ?? null,
            'website_url' => $validatedData['website_url'] ?? null,
            'start_date' => $validatedData['start_date'] ?? null,
            'termination_date' => $validatedData['termination_date'] ?? null,
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        DB::table('micro_quick_links')->insert($data);
        // Redirect or return response

        MicroManageAudit::create([
            'Module_Name' => 'Quick Links', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('microquicklinks.index')->with('success', 'Data added successfully!');
    }

    // Category edit method to show the edit form for a specific section
    public function quick_link_edit($id)
    {
        $quickLink = DB::table('micro_quick_links')->find($id);
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id');
    
        return view('admin.micro.quick_links.edit', compact('quickLink', 'researchCentres'));
    }

    // Category update method to handle form submission for updating section details
   // Update method to handle form submission for updating an existing survey
public function quick_link_update(Request $request, $id)
{
    
    // Validate the incoming request data
    $validatedData = $request->validate([
        'research_centre_id' => 'required|integer',
        'language' => 'required|in:1,2',
        'categorytype' => 'required|in:1,2',
        'txtename' => 'required|string|max:255',
        'menu_type' => 'required|in:1,2,3',
        'meta_title' => 'nullable|string|max:255',
        'meta_keyword' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'description' => 'nullable|string',
        'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        'website_url' => 'nullable|url',
        'start_date' => 'nullable|date',
        'termination_date' => 'nullable|date',
        'status' => 'required|in:1,0',
    ]);

    $data = $validatedData;
    if ($request->hasFile('pdf_file')) {
        $filePath = $request->file('pdf_file')->store('quick_links', 'public');
        $data['pdf_file'] = $filePath;
    }

    DB::table('micro_quick_links')->where('id', $id)->update($data);

    MicroManageAudit::create([
        'Module_Name' => 'Quick Links', // Static value
        'Time_Stamp' => time(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Update', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
    ]);

    return redirect()->route('microquicklinks.index')->with('success', 'Quick Link updated successfully!');
}


    // Category destroy method to delete a section
    public function quick_link_destroy($id)
    {
        DB::table('micro_quick_links')->where('id', $id)->delete();
        return redirect()->route('microquicklinks.index')->with('success', 'microquicklinks deleted successfully');
    }}
