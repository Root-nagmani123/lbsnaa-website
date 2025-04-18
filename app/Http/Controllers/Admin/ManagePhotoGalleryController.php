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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
        $mediaCategories = DB::table('manage_media_categories')
            ->where('status', 1)
            ->where('media_gallery', 'Photo Gallery')
            ->get(); // Retrieve records with status == 1
        return view('admin.manage_photo.create', compact('mediaCategories'));
    }
    


    public function store(Request $request)
    {
        // Validate inputs 
        $rules = [
            'image_title_english' => 'required|string|max:255', 
            'status' => 'required|in:1,0', 
            'image_files' => 'required|array',
            'media_categories' => 'required',
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:10240', 
        ];
    
        // Custom error messages
        $messages = [
            'image_title_english.required' => 'Enter an image title in English.',
            'status.required' => 'Select a status.',
            'status.in' => 'Status must be active (1) or inactive (0).',
            'image_files.required' => 'Please upload at least one image.',
            'media_categories.required' => 'Select a media category.',
            'image_files.*.mimes' => 'Only JPEG, PNG, and JPG images are allowed.',
            'image_files.*.max' => 'Each image must not exceed 10MB.',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If Validation Fails
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  

        // Collect image files if provided
        $imageFiles = $request->file('image_files');
        $data1 = [];

        // If files are uploaded, process them
        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                // Save image and get the path
                $data1[] = $file->store('uploads/gallery', 'public');
                if (!$data1) {
                    Cache::put('error_message', 'Failed to upload file!', 1);
                    return redirect(session('url.previousdata', url('/')))->withInput();
                    // return redirect()->back()->with('error', 'Failed to upload file.');
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
            'media_categories'=> $request->input('media_categories'),
            'created_at' => now(), // Add timestamp for created_at
            'updated_at' => now(), // Add timestamp for updated_at
        ];

        // Insert all data in a single query
        if (!empty($data)) {
            ManagePhotoGallery::insert($data);
        }
        Cache::put('success_message', 'Gallery added successfully!', 1);

        return redirect()->route('photo-gallery.index');
    }

    public function edit(Request $request, $id)
    {
        // Fetch the specific gallery with its associated course
        $gallery = ManagePhotoGallery::with('courses')->find($id);

        // If gallery not found, return 404 error
        if (!$gallery) {
            abort(404, 'Gallery not found');
        }

        // Fetch active media categories
        $mediaCategories = DB::table('manage_media_categories')
                            ->where('status', 1)
                            ->pluck('name', 'id'); // Use pluck for a key-value array

        // Fetch the course associated with the gallery
        $allCourses = Course::select('id', 'name')->find($gallery->course_id);

        // Fetch related courses
        $relatedNews = ManagePhotoGallery::select('related_news')
                        ->where('related_news', $gallery->related_news)
                        ->first();

        $relatedTrainingProgram = ManagePhotoGallery::select('related_training_program')
                                ->where('related_training_program', $gallery->related_training_program)
                                ->first();

        $relatedEvents = ManagePhotoGallery::select('related_events')
                        ->where('related_events', $gallery->related_events)
                        ->first();

        // Fetch course names (simplified)
        $aaa = $allCourses ? $allCourses->name : 'No Course Found';
        $bbb = $relatedNews ? Course::where('id', $relatedNews->related_news)->value('name') : 'No Related News Course';
        $ccc = $relatedTrainingProgram ? Course::where('id', $relatedTrainingProgram->related_training_program)->value('name') : 'No Related Training Program';
        $ddd = $relatedEvents ? Course::where('id', $relatedEvents->related_events)->value('name') : 'No Related Event Course';

        return view('admin.manage_photo.edit', [
            'gallery' => $gallery,
            'mediaCategories' => $mediaCategories, // Pass categories as key-value
            'aaa' => $aaa,
            'bbb' => $bbb,
            'ccc' => $ccc,
            'ddd' => $ddd,
        ]);
    }


    public function update(Request $request, $id)
    {
        // Validate inputs
         // Validate inputs 
         $rules = [
            'image_title_english' => 'required|string|max:255', 
            'status' => 'required|in:1,0', 
            'image_files' => 'required|array',
            'media_categories' => 'required',
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:10240', 
        ];
    
        // Custom error messages
        $messages = [
            'image_title_english.required' => 'Enter an image title in English.',
            'status.required' => 'Select a status.',
            'status.in' => 'Status must be active (1) or inactive (0).',
            'image_files.required' => 'Please upload at least one image.',
            'media_categories.required' => 'Select a media category.',
            'image_files.*.mimes' => 'Only JPEG, PNG, and JPG images are allowed.',
            'image_files.*.max' => 'Each image must not exceed 10MB.',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If Validation Fails
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  


        $gallery = ManagePhotoGallery::findOrFail($id);

        // Decode existing image files
        $existingImages = json_decode($gallery->image_files, true) ?? [];

        // Initialize updated image list
        $updatedImages = [];

        // Handle replaced files
        if ($request->has('replaced_files')) {
            foreach ($request->input('replaced_files') as $index => $isReplaced) {
                if ($isReplaced === "true") {
                    // Remove the old file from storage
                    if (isset($existingImages[$index])) {
                        $oldFile = $existingImages[$index];
                        $filePath = storage_path('app/public/' . $oldFile);
                        if (file_exists($filePath)) {
                            unlink($filePath); // Delete old file
                        }
                    } 

                    // Add the new uploaded file
                    if ($request->hasFile("image_files.{$index}")) {
                        $updatedImages[$index] = $request->file("image_files.{$index}")->store('uploads/gallery', 'public');
                    }
                } else {
                    // Retain the old file if not replaced
                    $updatedImages[$index] = $existingImages[$index] ?? null;
                }
            }
        }

        // Handle new files added dynamically
        if ($request->hasFile('image_files.new')) {
            foreach ($request->file('image_files.new') as $newFile) {
                $updatedImages[] = $newFile->store('uploads/gallery', 'public');
            }
        }

        // Save updated image list
        $gallery->image_files = json_encode(array_values($updatedImages));

        // Update other fields, allowing null or blank values
        $gallery->image_title_english = $request->input('image_title_english', 'Default Title');
        $gallery->image_title_hindi = $request->input('image_title_hindi') ?: null; // Set null if blank
        $gallery->status = $request->input('status', 'Draft');
        $gallery->course_id = $request->input('course_id') ?: null; // Set null if blank
        $gallery->related_news = $request->input('related_news') ?: null;
        $gallery->related_training_program = $request->input('related_training_program') ?: null;
        $gallery->related_events = $request->input('related_events') ?: null;
        $gallery->media_categories = $request->input('media_categories') ?: null;
        $gallery->updated_at = now();

        $gallery->save();

        // Log the update action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Photo Gallery',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);
        Cache::put('success_message', 'Gallery updated successfully!', 1);

        return redirect()->route('photo-gallery.index');
    }

   
     
    public function destroy($id){
        try {
            // Fetch the record using the ID
            $gallery = ManagePhotoGallery::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($gallery->status == 1) {
        Cache::put('error_message', 'Active galleries cannot be deleted.', 1);
                
                return redirect()->route('photo-gallery.index');
            }

            // Delete associated images from storage
            $images = json_decode($gallery->image_files, true) ?? [];
            foreach ($images as $image) {
                $imagePath = storage_path('app/public/' . $image);

                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                    Log::info("Deleted image: $imagePath");
                } else {
                    Log::warning("Image not found during deletion: $imagePath");
                }
            }

            // Delete the gallery record
            $gallery->delete();
            Cache::put('success_message', 'Photo Gallery deleted successfully.', 1);

            return redirect()->route('photo-gallery.index')->with('success', 'Photo Gallery deleted successfully.');
        } catch (\Exception $e) {
            // Handle errors and return with an error message
        Cache::put('error_message', 'Error deleting Photo Gallery: ' . $e->getMessage(), 1);

            return redirect()->route('photo-gallery.index');
        }
    }

    public function searchCourses(Request $request) {
        $query = $request->query('query');
        $courses = Course::where('name', 'LIKE', '%' . $query . '%')->limit(10)->get(['id', 'name']);
        return response()->json($courses);
    }

    public function show($id) {
        $photos = ManagePhotoGallery::where('gallery_id', $id)->get();  // Returns a collection
        return view('admin.manage_photo.edit', compact('photos'));
    }

}