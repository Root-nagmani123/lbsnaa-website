<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageMediaCategories;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageMediaCategoriesController extends Controller
{
    public function index()
    {
        $categories = ManageMediaCategories::all();
        return view('admin.manage_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('manage_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $media = ManageMediaCategories::create($validated);

        // ManageAudit::create([
        //     'Module_Name' => 'Media Module', // Static value
        //     'Time_Stamp' => now(), // Current timestamp
        //     'Created_By' => null, // ID of the authenticated user
        //     'Updated_By' => null, // No update on creation, so leave null
        //     'Action_Type' => 'Insert', // Static value
        //     'IP_Address' => $request->ip(), // Get IP address from request
        //     'Current_State' => json_encode($media), // Save state as JSON
        // ]);

        return redirect()->route('media-categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        return view('admin.manage_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $category = ManageMediaCategories::findOrFail($id);
        $category->update($validated);

        ManageAudit::create([
            'Module_Name' => 'Media Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($category), // Save state as JSON
        ]);

        return redirect()->route('media-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('media-categories.index')->with('success', 'Category deleted successfully.');
    }
}
