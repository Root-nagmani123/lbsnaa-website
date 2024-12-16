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
        // Validate the incoming request with custom error messages
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'required|string',
            'status' => 'required|integer|in:1,0',
        ], [
            // Custom validation messages
            'media_gallery.required' => 'Please select a gallery type.',
            'media_gallery.in' => 'Please select either Photo Gallery or Video Gallery.',
            'name.required' => 'Please enter the name.',
            'name.string' => 'The name must be a valid string.',
            'hindi_name.string' => 'The Hindi name must be a valid string.',
            'status.required' => 'Please select a status.',
            'status.integer' => 'The status must be a valid integer.',
            'status.in' => 'The status must be one of the following: Active, Inactive.',
        ]);

        // Create a new media category entry
        $media = ManageMediaCategories::create($validated);

        // Create a new audit record
        ManageAudit::create([
            'Module_Name' => 'Media Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect back to the media categories index with success message
        return redirect()->route('media-categories.index')->with('success', 'Category added successfully.');
    }


    public function edit($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        return view('admin.manage_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request with custom error messages
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,0',
        ], [
            'media_gallery.required' => 'Please select a gallery type.',
            'name.required' => 'Please enter the name.',
            'status.required' => 'Please select a status.',
        ]);

        // Find the category by ID or fail if not found
        $category = ManageMediaCategories::findOrFail($id);

        // Store the current state before updating for auditing purposes
        $currentState = $category->toArray(); // Convert the current category data to an array for auditing

        // Update the category with validated data
        $category->update($validated);

        // Create a new audit record
        ManageAudit::create([
            'Module_Name' => 'Media Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user (optional, if needed)
            'Updated_By' => null, // Update with authenticated user's ID if logged in
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // IP address of the user performing the update
        ]);

        // Redirect with success message
        return redirect()->route('media-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        try {
            // Find the category by ID
            $category = ManageMediaCategories::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($category->status == 1) {
                return redirect()->route('media-categories.index')->with('error', 'Inactive categories cannot be deleted.');
            }

            // Delete the category
            $category->delete();

            // Redirect with a success message
            return redirect()->route('media-categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            // Handle errors gracefully and return an error message
            return redirect()->route('media-categories.index')->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }

}
