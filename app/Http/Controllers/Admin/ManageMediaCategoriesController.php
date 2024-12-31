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
        // Validate the incoming request
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'required|string',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow nullable
        ]);
    
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/category_images'), $imageName);
            $validated['category_image'] = $imageName;
        } else {
            $validated['category_image'] = null; // Explicitly set null
        }
        
    
        // Save media category
        $media = ManageMediaCategories::create($validated);
    
        // Audit log
        ManageAudit::create([
            'Module_Name' => 'Media Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
    
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
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ], [
            'media_gallery.required' => 'Please select a gallery type.',
            'name.required' => 'Please enter the name.',
            'status.required' => 'Please select a status.',
            'category_image.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or GIF).',
            'category_image.max' => 'The image size must not exceed 2MB.',
        ]);

        // Find the category by ID or fail if not found
        $category = ManageMediaCategories::findOrFail($id);

        // Store the current state before updating for auditing purposes
        $currentState = $category->toArray(); // Convert the current category data to an array for auditing

        // Handle image upload if a new image is provided
        if ($request->hasFile('category_image')) {
            // Retrieve the uploaded file
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Generate a unique file name
            $image->move(public_path('uploads/category_images'), $imageName); // Save the image in public/uploads/category_images

            // Delete the old image file if it exists
            if ($category->category_image && file_exists(public_path('uploads/category_images/' . $category->category_image))) {
                unlink(public_path('uploads/category_images/' . $category->category_image));
            }

            // Update the validated data with the new image name
            $validated['category_image'] = $imageName;
        }

        // Update the category with validated data
        $category->update($validated);

        // Create a new audit record
        ManageAudit::create([
            'Module_Name' => 'Media Module',
            'Time_Stamp' => time(), // Use current timestamp
            'Created_By' => null, // Update with the ID of the authenticated user if available
            'Updated_By' => null, // Add authenticated user's ID
            'Action_Type' => 'Update', // Indicate the action performed
            'IP_Address' => $request->ip(), // Get the IP address of the request
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
                return redirect()->route('media-categories.index')->with('error', 'Active categories cannot be deleted.');
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
