<?php 
namespace App\Http\Controllers\Admin\Micro; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Micro\MicroManageMediaCategories;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $researchCentres = DB::table('research_centres')
        ->where('status', 1)  // Filter where status is 1
        ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names

        return view('admin.micro.manage_media_center.manage_categories.create',compact('researchCentres'));

        // return view('admin.micro.manage_media_center.manage_categories.create');
    }


    // public function store(Request $request)
    // {
    //     // Validate inputs
    //     $validated = $request->validate([
    //         'media_gallery' => 'required|integer|in:1,2',
    //         'name' => 'required|string|max:255',
    //         'research_centre' => 'required|string|max:255',
    //         'hindi_name' => 'nullable|string|max:255',
    //         'status' => 'required|integer|in:1,0',
    //         'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4098',
    //     ]);
    
    //     // Handle file upload
    //     if ($request->hasFile('category_image')) {
    //         try {
    //             // Retrieve the uploaded file
    //             $image = $request->file('category_image');
                
    //             // Store the file in the 'public/uploads/category_images' directory
    //             $imagePath = $image->store('uploads/category_images', 'public');
                
    //             // Save only the filename in the database
    //             $validated['category_image'] = basename($imagePath);
    //         } catch (\Exception $e) {
    //             \Log::error('File upload error: ' . $e->getMessage());
    //             return redirect()->back()->with('error', 'Error while uploading the image.');
    //         }
    //     } else {
    //         // If no image is uploaded, set it to null
    //         $validated['category_image'] = null;
    //     }
    
    //     // Using Query Builder to insert data into the database
    //     try {
    //         \DB::table('micro_media_categories')->insert([
    //             'media_gallery' => $validated['media_gallery'],
    //             'name' => $validated['name'],
    //             'research_centre' => $validated['research_centre'],
    //             'hindi_name' => $validated['hindi_name'],
    //             'status' => $validated['status'],
    //             'category_image' => $validated['category_image'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Database Insert Error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Failed to save category.');
    //     }
    
    //      // Audit log
    //     MicroManageAudit::create([
    //         'Module_Name' => 'Media Photo Video',
    //         'Time_Stamp' => time(),
    //         'Created_By' => null,
    //         'Updated_By' => null,
    //         'Action_Type' => 'Insert',
    //         'IP_Address' => $request->ip(),
    //     ]);
    
    //     return redirect()->route('photovideogallery.index')->with('success', 'Category added successfully.');
    // }


    public function store(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'media_gallery' => 'required|integer|in:1,2',
            'name' => 'required|string|max:255',
            'research_centre' => 'required|string|max:255',
            'hindi_name' => 'nullable|string|max:255',
            'status' => 'required|integer|in:1,0',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4098',  // 'nullable' so it's not required on edit
        ]);

        // Handle file upload
        if ($request->hasFile('category_image')) {
            try {
                // Retrieve the uploaded file
                $image = $request->file('category_image');
                
                // Store the file in the 'public/uploads/category_images' directory
                $imagePath = $image->store('uploads/category_images', 'public');
                
                // Save only the filename in the database
                $validated['category_image'] = basename($imagePath);
            } catch (\Exception $e) {
                \Log::error('File upload error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error while uploading the image.');
            }
        } else {
            // If no image is uploaded, retain the old image (if available)
            $validated['category_image'] = $request->input('old_category_image') ?? null;
        }

        // Save or update the category
        try {
            if ($request->has('id')) {
                // Update category if 'id' is provided
                \DB::table('micro_media_categories')->where('id', $request->input('id'))->update([
                    'media_gallery' => $validated['media_gallery'],
                    'name' => $validated['name'],
                    'research_centre' => $validated['research_centre'],
                    'hindi_name' => $validated['hindi_name'],
                    'status' => $validated['status'],
                    'category_image' => $validated['category_image'],
                    'updated_at' => now(),
                ]);
            } else {
                // Insert new category if no 'id' is provided
                \DB::table('micro_media_categories')->insert([
                    'media_gallery' => $validated['media_gallery'],
                    'name' => $validated['name'],
                    'research_centre' => $validated['research_centre'],
                    'hindi_name' => $validated['hindi_name'],
                    'status' => $validated['status'],
                    'category_image' => $validated['category_image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Database Insert/Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save category.');
        }

        // Audit log
        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert/Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('photovideogallery.index')->with('success', 'Category saved successfully.');
    }

    
    
    public function edit($id)
    {
        $category = MicroManageMediaCategories::findOrFail($id);
        $researchCentres = DB::table('research_centres')
        ->where('status', 1)  // Filter where status is 1
        ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names
        // dd($researchCentres);
        return view('admin.micro.manage_media_center.manage_categories.edit', compact('category','researchCentres'));
    }

    // public function update(Request $request, $id)
    // {
    //     // Validate the incoming request with custom error messages
    //     $validated = $request->validate([
    //         'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
    //         'name' => 'required|string|max:255',
    //         'hindi_name' => 'nullable|string|max:255',
    //         'status' => 'required|integer|in:1,0',
    //         'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image optional during update
    //     ], [
    //         'media_gallery.required' => 'Please select a gallery type.',
    //         'name.required' => 'Please enter the name.',
    //         'status.required' => 'Please select a status.',
    //         'category_image.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or GIF).',
    //         'category_image.max' => 'The image size must not exceed 2MB.',
    //     ]);

    //     // Find the category
    //     $category = MicroManageMediaCategories::findOrFail($id);

    //     // Handle the image upload if a new image is provided
    //     if ($request->hasFile('category_image')) {
    //         // Delete old image file if exists
    //         if ($category->category_image && file_exists(public_path('uploads/categories/' . $category->category_image))) {
    //             unlink(public_path('uploads/categories/' . $category->category_image));
    //         }

    //         // Store new image
    //         $image = $request->file('category_image');
    //         $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('uploads/categories'), $imageName);

    //         // Update validated data with the new image name
    //         $validated['category_image'] = $imageName;
    //     }

    //     // Update the category record
    //     $category->update($validated);

    //     // Audit trail
    //     MicroManageAudit::create([
    //         'Module_Name' => 'Media Photo Video', // Static value
    //         'Time_Stamp' => time(), // Use Laravel's now() for the current timestamp
    //         'Created_By' => null, // Replace with Auth::id() if using authentication
    //         'Updated_By' => null, // Authenticated user's ID
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Client IP address
    //     ]);

    //     // Redirect back with success message
    //     return redirect()->route('photovideogallery.index')->with('success', 'Category updated successfully.');
    // }


 

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'media_gallery' => 'required|integer|in:1,2',
            'name' => 'required|string|max:255',
            'hindi_name' => 'nullable|string|max:255',
            'status' => 'required|integer|in:1,0',
            'research_centre' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4098',
        ], [
            'media_gallery.required' => 'Please select a gallery type.',
            'name.required' => 'Please enter the name.',
            'status.required' => 'Please select a status.',
            'category_image.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or GIF).',
            'category_image.max' => 'The image size must not exceed 4MB.',
        ]);
    
        // Find the category by ID
        $category = MicroManageMediaCategories::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('category_image')) {
            // Log image details for debugging
            Log::info('Category image uploaded: ', [
                'original_name' => $request->file('category_image')->getClientOriginalName(),
                'mime_type' => $request->file('category_image')->getClientMimeType(),
                'size' => $request->file('category_image')->getSize(),
            ]);
    
            // Delete old image if exists
            if ($category->category_image && Storage::exists('public/category_images/' . $category->category_image)) {
                Storage::delete('public/category_images/' . $category->category_image);
            }
    
            // Save the new image
            $image = $request->file('category_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/category_images', $imageName);
    
            // Update validated data with the new image name
            $validated['category_image'] = $imageName;
        } else {
            // If no new image is uploaded, retain the old image
            $validated['category_image'] = $category->category_image;
        }
    
        // Update the category record with the validated data
        $category->update($validated);
    
        // Audit trail (you can add the user and other details)
        MicroManageAudit::create([
            'Module_Name' => 'Media Photo Video',
            'Time_Stamp' => time(),
            'Created_By' => null, // Replace with Auth::id() if using authentication
            'Updated_By' => null, // Replace with Auth::id() if using authentication
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
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