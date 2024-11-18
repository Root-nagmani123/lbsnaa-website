<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        DB::table('research_centres')->insert([
            'language' => $validatedData['language'],
            'research_centre_name' => $validatedData['research_centre_name'],
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
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
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'updated_at' => now(),
        ]);

        return redirect()->route('researchcentres.index')->with('success', 'Research Centre updated successfully!');
    }

    public function researchcentresDestroy($id)
    {
        DB::table('research_centres')->where('id', $id)->delete();

        return redirect()->route('researchcentres.index')->with('success', 'Research Centre deleted successfully!');
    }
}