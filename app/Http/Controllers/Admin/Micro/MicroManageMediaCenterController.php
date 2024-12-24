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

        // Fetching active research centres where status == 1
        $researchCentres = DB::table('research_centres')
        ->where('status', 1) // Filter only active records
        ->pluck('research_centre_name', 'id');

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
        // Validate inputs
        $validated = $request->validate([
            'media_gallery' => 'required|integer|in:1,2',
            'name' => 'required|string|max:255',
            'research_centre' => 'required|string|max:255',
            'hindi_name' => 'nullable|string|max:255',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload
        if ($request->hasFile('category_image')) {
            try {
                $image = $request->file('category_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('uploads/category_images');
                
                if ($image->move($destinationPath, $imageName)) {
                    $validated['category_image'] = $imageName;
                    \Log::info('Image Uploaded Successfully', ['filename' => $imageName]);
                } else {
                    \Log::error('File upload failed.');
                    return redirect()->back()->with('error', 'Failed to upload image.');
                }
            } catch (\Exception $e) {
                \Log::error('File Upload Exception: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error while uploading image.');
            }
        } else {
            $validated['category_image'] = null;
            \Log::info('No Image Provided');
        }
    
        // Save to database
        try {
            $media = MicroManageMediaCategories::create($validated);
            \Log::info('Data Inserted:', $validated);
        } catch (\Exception $e) {
            \Log::error('Database Insert Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save category.');
        }
    
        // Audit log
        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
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
        // Validate the incoming request with custom error messages
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string|max:255',
            'hindi_name' => 'nullable|string|max:255',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optional during update
        ], [
            'media_gallery.required' => 'Please select a gallery type.',
            'name.required' => 'Please enter the name.',
            'status.required' => 'Please select a status.',
            'category_image.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or GIF).',
            'category_image.max' => 'The image size must not exceed 2MB.',
        ]);

        // Find the category
        $category = MicroManageMediaCategories::findOrFail($id);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('category_image')) {
            // Delete old image file if exists
            if ($category->category_image && file_exists(public_path('uploads/categories/' . $category->category_image))) {
                unlink(public_path('uploads/categories/' . $category->category_image));
            }

            // Store new image
            $image = $request->file('category_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);

            // Update validated data with the new image name
            $validated['category_image'] = $imageName;
        }

        // Update the category record
        $category->update($validated);

        // Audit trail
        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video', // Static value
            'Time_Stamp' => time(), // Use Laravel's now() for the current timestamp
            'Created_By' => null, // Replace with Auth::id() if using authentication
            'Updated_By' => null, // Authenticated user's ID
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Client IP address
        ]);

        // Redirect back with success message
        return redirect()->route('photovideogallery.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        // Fetch the category record
        $category = MicroManageMediaCategories::findOrFail($id);

        // Check if status is 1 (inactive)
        if ($category->status == 1) {
            return redirect()->route('photovideogallery.index')
                ->with('error', 'Active categories cannot be deleted.');
        }

        // Proceed to delete if status is not 1
        $category->delete();

        return redirect()->route('photovideogallery.index')
            ->with('success', 'Category deleted successfully.');
    }

}