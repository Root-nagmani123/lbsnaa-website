<?php 
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroManagePhotoGallery;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth; 

class MicroManagePhotoGalleryController extends Controller
{ 
    public function index()
    {
        // $galleries = DB::table('micro_manage_photo_galleries as sub')
        // ->leftJoin('courses as parent', 'sub.course_id', '=', 'parent.id') // Correct join
        // ->leftJoin('courses as second_row', 'sub.related_training_program', '=', 'second_row.id') // Correct join
        // ->select('sub.*', 'parent.id', 'parent.name','second_row.name as media_cat_name') // Select the necessary columns
        // ->get();
        $galleries = DB::table('micro_manage_photo_galleries as sub')
        ->leftJoin('courses as parent', 'sub.course_id', '=', 'parent.id') // Correct join
        ->leftJoin('courses as second_row', 'sub.related_training_program', '=', 'second_row.id') // Correct join
        ->select(
            'sub.*',                    // All columns from micro_manage_photo_galleries
            'parent.id as course_id',   // Alias for parent.id to avoid overwriting sub.id
            'parent.name',              // Course name from parent
            'second_row.name as media_cat_name' // Media category name
        )
        ->get();

        // print_r($galleries);
        return view('admin.micro.manage_media_center.manage_photo.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.micro.manage_media_center.manage_photo.create'); 
    }


    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'image_files' => 'required|array',
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ensure image files are provided
        $imageFiles = $request->file('image_files');

        if (!$imageFiles) {
            return redirect()->back()->with('error', 'No images uploaded!');
        }

        // Collect data for all images
        $data1 = [];
        foreach ($imageFiles as $file) {
            // Save image and get the path
            $data1[] = $file->store('uploads/gallery', 'public');
            if (!$data1) {
                return redirect()->back()->with('error', 'Failed to upload file.');
            }
        }
        // print_r( json_encode($data1));die;
            // Prepare data for insertion
        $data[] = [
            'image_title_english' => $request->input('image_title_english', 'Default Title'),
            'image_title_hindi' => $request->input('image_title_hindi'),
            'status' => $request->input('status', 'Draft'),
            'image_files' => json_encode($data1),
            'course_id' => $request->input('course_id'),
            'related_news' => $request->input('related_news'),
            'related_training_program' => $request->input('related_training_program'),
            'related_events' => $request->input('related_events'),
            'created_at' => now(), // Add timestamp for created_at
            'updated_at' => now(), // Add timestamp for updated_at
        ];

        // Insert all data in a single query
        if (!empty($data)) {
            MicroManagePhotoGallery::insert($data);
        }

        MicroManageAudit::create([
            'Module_Name' => 'Photo Gallery',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('micro-photo-gallery.index')->with('success', 'Gallery added successfully.');
    }


    public function edit(Request $request, $id)
    {
        // Fetch the specific gallery with its associated course
        $gallery = DB::table('micro_manage_photo_galleries as sub')
        ->leftJoin('courses as parent', 'sub.course_id', '=', 'parent.id') 
        ->where('sub.id', $id)
        ->select('sub.*', 'parent.id as parent_id', 'parent.name as parent_name')
        ->first();



        if (!$gallery) {
            abort(404, 'Gallery not found');
        }

        // Fetch related data only if the fields are not null
        $related_news = $gallery->related_news 
            ? MicroManagePhotoGallery::select('id', 'related_news')->where('related_news', $gallery->related_news)->first()
            : null;

        $related_training_program = $gallery->related_training_program 
            ? MicroManagePhotoGallery::select('id', 'related_training_program')->where('related_training_program', $gallery->related_training_program)->first()
            : null;

        $related_events = $gallery->related_events 
            ? MicroManagePhotoGallery::select('id', 'related_events')->where('related_events', $gallery->related_events)->first()
            : null;

        // Fetch the course for dropdown
        $allCourses = Course::select('id', 'name')->where('id', $gallery->course_id)->first();

        $bbb = $related_news ? Course::select('id', 'name')->where('id', $related_news->related_news)->first() : null;
        $ccc = $related_training_program ? Course::select('id', 'name')->where('id', $related_training_program->related_training_program)->first() : null;
        $ddd = $related_events ? Course::select('id', 'name')->where('id', $related_events->related_events)->first() : null;

        return view('admin.micro.manage_media_center.manage_photo.edit', [
            'gallery' => $gallery,
            'allCourses' => $allCourses,
            'aaa' => $allCourses ? $allCourses->name : null,
            'bbb' => $bbb ? $bbb->name : null,
            'ccc' => $ccc ? $ccc->name : null,
            'ddd' => $ddd ? $ddd->name : null,
        ]);
    }




    public function update(Request $request, $id)
    {
        // Validate inputs
        $request->validate([
            'image_files' => 'nullable|array',
            'image_files.*' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Find the gallery by ID
        $gallery = MicroManagePhotoGallery::findOrFail($id);
    
        // Get the old image paths (if any)
        $oldImages = json_decode($gallery->image_files, true);
    
        // Remove old images from storage if they exist
        if ($oldImages) {
            foreach ($oldImages as $oldImage) {
                $imagePath = storage_path('app/public/uploads/gallery/' . $oldImage);
    
                // Check if the file exists before attempting to delete
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    Log::info("Old image removed: $imagePath");  // Log successful removal
                } else {
                    Log::warning("Old image not found: $imagePath");  // Log if file not found
                }
            }
        } else {
            Log::info("No old images to remove.");  // Log if no old images
        }
    
        // Process new image files if they are uploaded
        $imageFiles = $request->file('image_files');
        $uploadedFiles = [];
    
        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                // Store new files and get their paths
                $uploadedFiles[] = $file->store('uploads/gallery', 'public');
            }
        }
    
        // If there are new images, save them in the database
        if (count($uploadedFiles) > 0) {
            // Merge old images with the newly uploaded ones (if any)
            $updatedImages = array_merge($oldImages ?? [], $uploadedFiles);
            $gallery->image_files = json_encode($updatedImages);
        } else {
            // If no new images are uploaded, keep the old images in the database
            $gallery->image_files = json_encode($oldImages);
        }
    
        // Update other fields
        $gallery->image_title_english = $request->input('image_title_english', 'Default Title');
        $gallery->image_title_hindi = $request->input('image_title_hindi');
        $gallery->status = $request->input('status', 'Draft');
        $gallery->course_id = $request->input('course_id');
        $gallery->related_news = $request->input('related_news');
        $gallery->related_training_program = $request->input('related_training_program');
        $gallery->related_events = $request->input('related_events');
        $gallery->updated_at = now();
    
        // Save the gallery
        $gallery->save();
    
        MicroManageAudit::create([
            'Module_Name' => 'Photo Gallery',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('micro-photo-gallery.index')->with('success', 'Gallery updated successfully.');
    }
    
    public function destroy($id)
    {
        try {
            // Fetch the record using the ID and delete it
            $gallery = MicroManagePhotoGallery::findOrFail($id); // Assuming 'MicroManagePhotoGallery' is your model
            $gallery->delete();

            return redirect()->route('micro-photo-gallery.index')->with('success', 'Photo Gallery deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('micro-photo-gallery.index')->with('error', 'Error deleting Photo Gallery: ' . $e->getMessage());
        }
    }

    public function searchCourses(Request $request)
    {
        $query = $request->query('query');
        $courses = Course::where('name', 'LIKE', '%' . $query . '%')->limit(10)->get(['id', 'name']);
        return response()->json($courses);
    }


    public function show($id)
    {
        $photos = MicroManagePhotoGallery::where('gallery_id', $id)->get();  // Returns a collection
        return view('admin.micro.manage_media_center.manage_photo.edit', compact('photos'));
    }

}