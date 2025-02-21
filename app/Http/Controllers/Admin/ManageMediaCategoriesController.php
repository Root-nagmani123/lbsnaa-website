<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageMediaCategories;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
        $rules = [
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'required|string',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow nullable
        ];
    
        // Custom validation messages (optional)
        $messages = [
            'media_gallery.required' => 'Please select a media gallery type.',
            'media_gallery.in' => 'Media gallery must be either "Photo Gallery" or "Video Gallery".',
            'name.required' => 'Please enter a name.',
            'hindi_name.required' => 'Please enter a Hindi name.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Status must be either 1 (Active) or 0 (Inactive).',
            'category_image.image' => 'The file must be an image.',
            'category_image.mimes' => 'Only JPEG, PNG, JPG, and GIF formats are allowed.',
            'category_image.max' => 'The image size must not exceed 2MB.',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  
    
        $validated = $validator->validated();

        // Handle category image upload
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
            'Created_By' => auth()->id() ?? null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
    
        // Cache success message
        Cache::put('success_message', 'Category added successfully!', 1);
    
    
        return redirect()->route('media-categories.index');
    }
    

    public function edit($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        return view('admin.manage_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request with custom error messages
        $rules = [
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'required|string',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow nullable
        ];
    
        // Custom validation messages (optional)
        $messages = [
            'media_gallery.required' => 'Please select a media gallery type.',
            'media_gallery.in' => 'Media gallery must be either "Photo Gallery" or "Video Gallery".',
            'name.required' => 'Please enter a name.',
            'hindi_name.required' => 'Please enter a Hindi name.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Status must be either 1 (Active) or 0 (Inactive).',
            'category_image.image' => 'The file must be an image.',
            'category_image.mimes' => 'Only JPEG, PNG, JPG, and GIF formats are allowed.',
            'category_image.max' => 'The image size must not exceed 2MB.',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  
        $validated = $validator->validated();
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
        Cache::put('success_message', 'Category updated successfully!', 1);

        // Redirect with success message
        return redirect()->route('media-categories.index');
    }


    public function destroy($id)
    {
        try {
            // Find the category by ID
            $category = ManageMediaCategories::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($category->status == 1) {
        Cache::put('error_message', 'Active categories cannot be deleted.', 1);

                return redirect()->route('media-categories.index');
            }

            // Delete the category
            $category->delete();

            // Redirect with a success message
        Cache::put('success_message', 'Category deleted successfully!', 1);

            return redirect()->route('media-categories.index');
        } catch (\Exception $e) {
            // Handle errors gracefully and return an error message
            Cache::put('error_message', 'Error deleting category: ' . $e->getMessage(), 1);

            return redirect()->route('media-categories.index');
        }
    }

}
