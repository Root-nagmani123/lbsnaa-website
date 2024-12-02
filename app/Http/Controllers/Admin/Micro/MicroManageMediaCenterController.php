<?php 
namespace App\Http\Controllers\Admin\Micro; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Micro\MicroManageMediaCategories;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;


class MicroManageMediaCenterController extends Controller
{

    public function index()
    {
        // Fetching categories along with research centre name
        $categories = DB::table('micro_media_categories as tp')
            ->leftJoin('research_centres as rc', 'tp.research_centre', '=', 'rc.id')
            ->select('tp.*', 'rc.research_centre_name as research_centre_name')
            ->get();

        // Fetching all research centres (assuming you want to use them in your Blade view)
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id');

        // Passing both categories and researchCentres to the view
        return view('admin.micro.manage_media_center.manage_categories.index', compact('categories', 'researchCentres'));
    }


    public function create()
    {
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        return view('admin.micro.manage_media_center.manage_categories.create',compact('researchCentres'));

        // return view('admin.micro.manage_media_center.manage_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|integer|in:1,2',
            'name' => 'required|string',
            'research_centre' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,0',
        ]);

        $media = MicroManageMediaCategories::create($validated);

        
        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            // 'Current_State' => json_encode($media), // Save state as JSON
        ]);

        return redirect()->route('photovideogallery.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = MicroManageMediaCategories::findOrFail($id);
        return view('admin.micro.manage_media_center.manage_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|integer|in:1,2',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,0',
        ]);

        $category = MicroManageMediaCategories::findOrFail($id);
        $category->update($validated);

        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('photovideogallery.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = MicroManageMediaCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('photovideogallery.index')->with('success', 'Category deleted successfully.');
    }
}