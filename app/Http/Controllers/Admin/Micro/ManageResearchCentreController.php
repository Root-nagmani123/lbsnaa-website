<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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

    public function researchcentresStore(Request $request)
    {
        $validatedData = $request->validate([
            'language' => 'required|in:1,2',
            'research_centre_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        DB::table('research_centres')->insert([
            'language' => $validatedData['language'],
            'research_centre_name' => $validatedData['research_centre_name'],
            'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MicroManageAudit::create([
            'Module_Name' => 'Research Center', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('researchcentres.index')->with('success', 'Research Centre added successfully!');
    }

    public function researchcentresEdit($id)
    {
        $researchCentre = DB::table('research_centres')->where('id', $id)->first();
        return view('admin.micro.manage_researchcentre.edit', compact('researchCentre'));
    }

    public function researchcentresUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'language' => 'required|in:1,2',
            'research_centre_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        DB::table('research_centres')->where('id', $id)->update([
            'language' => $validatedData['language'],
            'research_centre_name' => $validatedData['research_centre_name'],
            'research_centre_slug' => Str::slug($validatedData['research_centre_name'], '-'),
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'updated_at' => now(),
        ]);

        MicroManageAudit::create([
            'Module_Name' => 'Research Center', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
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
