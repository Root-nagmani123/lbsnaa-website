<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        // Fetch only records where status is 1 (active/inactive based on your logic)
        $researchCentres = DB::table('research_centres')
                             ->where('status', 1)  // Add the condition for status == 1
                             ->pluck('research_centre_name', 'id'); // Replace 'research_centre_name' and 'id' with your actual column names.
    
        return view('admin.micro.quick_links.create', compact('researchCentres'));
    }


    public function quick_link_store(Request $request)
    {
        // Validate the input
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
            'start_date' => 'required|date',
            'termination_date' => 'required|date|after:start_date',
            'status' => 'required|in:1,0',
        ]);

        // Convert the start_date and termination_date to Y-m-d format using Carbon
        $startDate = Carbon::createFromFormat('d-m-Y', $validatedData['start_date'])->format('Y-m-d');
        $terminationDate = Carbon::createFromFormat('d-m-Y', $validatedData['termination_date'])->format('Y-m-d');

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
            'start_date' => $startDate,
            'termination_date' => $terminationDate,
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        DB::table('micro_quick_links')->insert($data);

        // Log the action
        MicroManageAudit::create([
            'Module_Name' => 'Quick Links',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('microquicklinks.index')->with('success', 'Data added successfully!');
    }



    public function quick_link_edit($id)
    {
        // Fetch the specific quick link by ID
        $quickLink = DB::table('micro_quick_links')->find($id);

        // Fetch research centres with status = 1
        $researchCentres = DB::table('research_centres')
                            ->where('status', 1)
                            ->pluck('research_centre_name', 'id');

        // Format the dates to 'DD-MM-YYYY' using Carbon
        $startDate = Carbon::parse($quickLink->start_date)->format('d-m-Y');
        $terminationDate = Carbon::parse($quickLink->termination_date)->format('d-m-Y');

        // Pass the formatted dates and research centres to the view
        return view('admin.micro.quick_links.edit', compact('quickLink', 'researchCentres', 'startDate', 'terminationDate'));
    }

    

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
            'start_date' => 'nullable|date_format:d-m-Y', // Ensure it's in DD-MM-YYYY format
            'termination_date' => 'required|date_format:d-m-Y|after_or_equal:start_date', // Ensure termination_date is after start_date
            'status' => 'required|in:1,0',
        ]);

        // Convert start_date and termination_date to 'Y-m-d' format if present
        if ($request->has('start_date')) {
            $startDate = Carbon::createFromFormat('d-m-Y', $validatedData['start_date'])->format('Y-m-d');
            $validatedData['start_date'] = $startDate;
        }

        if ($request->has('termination_date')) {
            $terminationDate = Carbon::createFromFormat('d-m-Y', $validatedData['termination_date'])->format('Y-m-d');
            $validatedData['termination_date'] = $terminationDate;
        }

        // Prepare the data for the update
        $data = $validatedData;

        // Check if there's a new PDF file and store it
        if ($request->hasFile('pdf_file')) {
            $filePath = $request->file('pdf_file')->store('quick_links', 'public');
            $data['pdf_file'] = $filePath;
        }

        // Update the database record
        DB::table('micro_quick_links')->where('id', $id)->update($data);

        // Log the action in the audit trail
        MicroManageAudit::create([
            'Module_Name' => 'Quick Links', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect back with a success message
        return redirect()->route('microquicklinks.index')->with('success', 'Quick Link updated successfully!');
    }

    public function quick_link_destroy($id)
    {
        // Retrieve the quick link from the database
        $quickLink = DB::table('micro_quick_links')->where('id', $id)->first();

        // Check if the status is 1 (Inactive)
        if ($quickLink && $quickLink->status == 1) {
            // If the status is inactive, prevent deletion and show an error message
            return redirect()->route('microquicklinks.index')->with('error', 'Active quick links cannot be deleted.');
        }

        // Proceed with deletion if the status is not 1 (Inactive)
        DB::table('micro_quick_links')->where('id', $id)->delete();

        // Redirect with a success message after deletion
        return redirect()->route('microquicklinks.index')->with('success', 'Quick link deleted successfully');
    }


}
