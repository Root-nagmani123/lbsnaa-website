<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManagePhotoGallery;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManagePhotoGalleryController extends Controller
{ 
    public function index() 
    {
        $galleries = DB::table('manage_photo_galleries as sub')
        ->leftJoin('courses as parent', 'sub.course_id', '=', 'parent.id') // Correct join
        ->leftJoin('courses as second_row', 'sub.related_training_program', '=', 'second_row.id') // Correct join
        ->leftJoin('courses as third_row', 'sub.related_news', '=', 'third_row.id') // Correct join
        ->leftJoin('courses as four_row', 'sub.related_events', '=', 'four_row.id') // Correct join
        ->select(
            'sub.*',                    // All columns from manage_photo_galleries
            'parent.id as course_id',   // Alias for parent.id to avoid overwriting sub.id
            'parent.name',              // Course name from parent
            'second_row.name as media_cat_name', // Media category name
            'third_row.name as related_news',
            'four_row.name as related_events'
        )
        ->get();
        
        return view('admin.manage_photo.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.manage_photo.create'); 
    }

    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'image_title_english' => 'required|string|max:255', // Ensure image title (English) is provided
            'status' => 'required|in:1,0', // Ensure status is required and can only be 1 or 2 (or change these values based on your needs)
            'image_files' => 'nullable|array', // Image files are not required
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:10240', // Ensure file is an image and max 10MB (10MB = 10240 KB)
        ]);

        // Collect image files if provided
        $imageFiles = $request->file('image_files');
        $data1 = [];

        // If files are uploaded, process them
        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                // Save image and get the path
                $data1[] = $file->store('uploads/gallery', 'public');
                if (!$data1) {
                    return redirect()->back()->with('error', 'Failed to upload file.');
                }
            }
        }

        // Prepare data for insertion
        $data[] = [
            'image_title_english' => $request->input('image_title_english'),
            'image_title_hindi' => $request->input('image_title_hindi'),
            'status' => $request->input('status'),
            'image_files' => !empty($data1) ? json_encode($data1) : null, // Only add if images were uploaded
            'course_id' => $request->input('course_id'),
            'related_news' => $request->input('related_news'),
            'related_training_program' => $request->input('related_training_program'),
            'related_events' => $request->input('related_events'),
            'created_at' => now(), // Add timestamp for created_at
            'updated_at' => now(), // Add timestamp for updated_at
        ];

        // Insert all data in a single query
        if (!empty($data)) {
            ManagePhotoGallery::insert($data);
        }

        return redirect()->route('photo-gallery.index')->with('success', 'Gallery added successfully.');
    }



    // public function edit(Request $request, $id)
    // {
    //     // Fetch the specific gallery with its associated course
    //     $gallery = ManagePhotoGallery::with('courses')->find($id);

    //     $related_news = ManagePhotoGallery::select('id', 'related_news')->where('related_news', $gallery->related_news)->first();
    //     $related_training_program = ManagePhotoGallery::select('id', 'related_training_program')->where('related_training_program', $gallery->related_training_program)->first();
    //     $related_events = ManagePhotoGallery::select('id', 'related_events')->where('related_events', $gallery->related_events)->first();


    //     if (!$gallery) {
    //         abort(404, 'Gallery not found');
    //     }
    //     // Fetch all courses for the dropdown
    //     $allCourses = Course::select('id', 'name')->where('id', $gallery->course_id)->first();
    //     $bbb = Course::select('id', 'name')->where('id', $related_news->related_news)->first();
    //     $ccc = Course::select('id', 'name')->where('id', $related_training_program->related_training_program)->first();
    //     $ddd = Course::select('id', 'name')->where('id', $related_events->related_events)->first();


    //     return view('admin.manage_photo.edit', [
    //         'gallery' => $gallery,
    //         'allCourses' => $allCourses,
    //         'aaa' => $allCourses->name,
    //         'bbb' => $bbb->name,
    //         'ccc' => $ccc->name,
    //         'ddd' => $ddd->name,
    //     ]);
    // }

    public function edit(Request $request, $id)
    {
        // Fetch the specific gallery with its associated course
        $gallery = ManagePhotoGallery::with('courses')->find($id);

        // If gallery not found, return 404 error
        if (!$gallery) {
            abort(404, 'Gallery not found');
        }

        // Fetch related courses
        $related_news = ManagePhotoGallery::select('id', 'related_news')->where('related_news', $gallery->related_news)->first();
        $related_training_program = ManagePhotoGallery::select('id', 'related_training_program')->where('related_training_program', $gallery->related_training_program)->first();
        $related_events = ManagePhotoGallery::select('id', 'related_events')->where('related_events', $gallery->related_events)->first();

        // Fetch the course associated with the gallery
        $allCourses = Course::select('id', 'name')->where('id', $gallery->course_id)->first();

        // Fetch the related courses (check if they exist before accessing)
        $bbb = $related_news ? Course::select('id', 'name')->where('id', $related_news->related_news)->first() : null;
        $ccc = $related_training_program ? Course::select('id', 'name')->where('id', $related_training_program->related_training_program)->first() : null;
        $ddd = $related_events ? Course::select('id', 'name')->where('id', $related_events->related_events)->first() : null;

        // If courses are not found, you can provide fallback names (or handle accordingly)
        $aaa = $allCourses ? $allCourses->name : 'No Course Found';
        $bbb = $bbb ? $bbb->name : 'No Related News Course';
        $ccc = $ccc ? $ccc->name : 'No Related Training Program';
        $ddd = $ddd ? $ddd->name : 'No Related Event Course';

        return view('admin.manage_photo.edit', [
            'gallery' => $gallery,
            'allCourses' => $allCourses,
            'aaa' => $aaa,
            'bbb' => $bbb,
            'ccc' => $ccc,
            'ddd' => $ddd,
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
        $gallery = ManagePhotoGallery::findOrFail($id);

        // Get the old image paths (if any)
        $oldImages = json_decode($gallery->image_files, true) ?? [];

        // Handle removed images
        if ($request->has('removed_files')) {
            $removedFiles = json_decode($request->input('removed_files'), true) ?? [];

            // Delete removed images from storage
            foreach ($removedFiles as $removedFile) {
                $imagePath = storage_path('app/public/' . $removedFile);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    Log::info("Removed image: $imagePath");
                } else {
                    Log::warning("Image not found for removal: $imagePath");
                }

                // Remove the file from the old images array
                $oldImages = array_filter($oldImages, function ($file) use ($removedFile) {
                    return $file !== $removedFile;
                });
            }
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

        // Merge remaining old images with newly uploaded images
        $updatedImages = array_merge($oldImages, $uploadedFiles);

        // Update the gallery with the new image data
        $gallery->image_files = json_encode($updatedImages);

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

        ManageAudit::create([
            'Module_Name' => 'Photo Gallery',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('photo-gallery.index')->with('success', 'Gallery updated successfully.');
    }


    public function destroy($id)
    {
        try {
            // Fetch the record using the ID and delete it
            $gallery = ManagePhotoGallery::findOrFail($id); // Assuming 'ManagePhotoGallery' is your model
            $gallery->delete();

            return redirect()->route('photo-gallery.index')->with('success', 'Photo Gallery deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('photo-gallery.index')->with('error', 'Error deleting Photo Gallery: ' . $e->getMessage());
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
        $photos = ManagePhotoGallery::where('gallery_id', $id)->get();  // Returns a collection
        return view('admin.manage_photo.edit', compact('photos'));
    }

}