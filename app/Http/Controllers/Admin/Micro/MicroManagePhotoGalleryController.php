<?php 
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroManagePhotoGallery;
use App\Models\Admin\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth; 

class MicroManagePhotoGalleryController extends Controller
{ 
    public function index()
    { 

        $galleries = DB::table('micro_manage_photo_galleries as sub')
        ->leftJoin('courses as parent', 'sub.course_id', '=', 'parent.id') // Correct join
        ->leftJoin('courses as second_row', 'sub.related_training_program', '=', 'second_row.id') // Correct join
        ->leftJoin('micro_media_categories as third_row', 'sub.media_categories', '=', 'third_row.id') // Correct join
        ->leftJoin('research_centres as four_row', 'sub.research_centre', '=', 'four_row.id') // Correct join
        ->select(
            'sub.*',                    // All columns from micro_manage_photo_galleries
            'parent.id as course_id',   // Alias for parent.id to avoid overwriting sub.id
            'parent.name',              // Course name from parent
            'second_row.name as media_cat_name', // Media category name
            'third_row.name as name',
            'four_row.research_centre_name as research_centre_name'
        )
        ->get();


        $getdata = DB::table('micro_manage_photo_galleries')
        ->where('status', 1)
        ->get(); // Fetching photo galleries where status is active

        // Fetching the active research centres
        $researchCentres = DB::table('research_centres')
            ->whereIn('research_centre_name', $getdata->pluck('research_centre')->toArray()) // Filter using plucked 'research_centre' values
            ->where('status', 1) // Filter only active research centres
            ->pluck('research_centre_name', 'id'); // Pluck research centre name and id

        // Fetch active media categories
        $mediaCategories = DB::table('micro_media_categories')
                            ->where('status', 1)
                            ->pluck('name', 'id'); // Use pluck for a key-value array
        
        return view('admin.micro.manage_media_center.manage_photo.index', compact('galleries', 'researchCentres'));
    }

    // public function create()
    // {
    //     $mediaCategories = DB::table('micro_media_categories')
    //         ->where('status', 1)
    //         ->where('media_gallery', 1)
    //         ->get(); // Retrieve records with status == 1 
            
            
    //     $researchCentres = DB::table('research_centres')
    //         ->where('status', 1)  // Filter where status is 1
    //         ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names

    //     return view('admin.micro.manage_media_center.manage_photo.create', compact('mediaCategories','researchCentres')); 
    // }


    public function create()
    {
        // Fetch media categories and join with research centres
        $mediaCategories = DB::table('micro_media_categories')
            ->join('research_centres', 'micro_media_categories.research_centre', '=', 'research_centres.id')
            ->where('micro_media_categories.status', 1)
            ->where('micro_media_categories.media_gallery', 1)
            ->select('micro_media_categories.id', 'micro_media_categories.name', 'research_centres.research_centre_name as centre_name')
            ->get();

        // Fetch research centres for the dropdown
        $researchCentres = DB::table('research_centres')
            ->where('status', 1)
            ->pluck('research_centre_name', 'id');

        // Pass data to the view
        return view('admin.micro.manage_media_center.manage_photo.create', compact('mediaCategories', 'researchCentres'));
    }

 
    public function store(Request $request)
    {
        // Validate inputs
        $rules = [
            'image_files' => 'required|array', // Ensure an array of images is provided
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:2048', // Validate each file in the array
            'image_title_english' => 'required|string|max:255', // Ensure the English title is provided
            'research_centre' => 'required|string', // Ensure research centre is provided
            'status' => 'required|integer|in:1,0', // Ensure status is either 1 or 0
            'media_categories' => 'required', // Ensure media categories are selected
        ];
        
        $messages = [
            'image_files.required' => 'Please upload at least one image.',
            'image_files.array' => 'Images must be uploaded as an array.',
            'image_files.*.mimes' => 'Each image must be of type: jpeg, png, jpg.',
            'image_files.*.max' => 'Each image must not exceed 2MB.',
            'image_title_english.required' => 'Please enter the English title.',
            'image_title_english.max' => 'The English title should not exceed 255 characters.',
            'research_centre.required' => 'Please select a research centre.',
            'status.required' => 'Please select a valid status.',
            'status.integer' => 'Status must be a valid number.',
            'status.in' => 'Invalid status selection.',
            'media_categories.required' => 'Please select at least one media category.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

        // Ensure image files are provided
        $imageFiles = $request->file('image_files');
        if (!$imageFiles) {
            return redirect()->back()->with('error', 'No images uploaded!');
        }

        // Collect data for all images
        $data1 = [];
        foreach ($imageFiles as $file) {
            // Save image and get the path
            $path = $file->store('uploads/gallery', 'public');
            if (!$path) {
                return redirect()->back()->with('error', 'Failed to upload file.');
            }
            $data1[] = $path;
        }

        // Prepare data for insertion
        $data[] = [
            'image_title_english' => $request->input('image_title_english'),
            'image_title_hindi' => $request->input('image_title_hindi'),
            'status' => $request->input('status'),
            'image_files' => json_encode($data1),
            'course_id' => $request->input('course_id'),
            'related_news' => $request->input('related_news'),
            'related_training_program' => $request->input('related_training_program'),
            'related_events' => $request->input('related_events'),
            'media_categories'=> $request->input('media_categories'),
            'research_centre' => $request->input('research_centre'),
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

        $researchCentres = DB::table('research_centres')
        ->where('status', 1)  // Filter where status is 1
        ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names

        if (!$gallery) {
            abort(404, 'Gallery not found'); 
        }

        // Fetch active media categories
        // $mediaCategories = DB::table('micro_media_categories')
        //                     ->where('status', 1)
        //                     ->where('media_gallery', 1)
        //                     ->pluck('name', 'id'); // Use pluck for a key-value array


        $mediaCategories = DB::table('micro_media_categories')
            ->join('research_centres', 'micro_media_categories.research_centre', '=', 'research_centres.id')
            ->where('micro_media_categories.status', 1)
            ->where('micro_media_categories.media_gallery', 1)
            ->select('micro_media_categories.id', 'micro_media_categories.name', 'research_centres.research_centre_name as centre_name')
            // ->get();
            ->pluck('name', 'id');



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
            'mediaCategories' => $mediaCategories, // Pass categories as key-value
            'aaa' => $allCourses ? $allCourses->name : null,
            'bbb' => $bbb ? $bbb->name : null,
            'ccc' => $ccc ? $ccc->name : null,
            'ddd' => $ddd ? $ddd->name : null,
            'researchCentres' => $researchCentres,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate inputs
        $rules = [
            'image_files' => 'required|array', // Ensure an array of images is provided
            'image_files.*' => 'file|mimes:jpeg,png,jpg|max:2048', // Validate each file in the array
            'image_title_english' => 'required|string|max:255', // Ensure the English title is provided
            'research_centre' => 'required|string', // Ensure research centre is provided
            'status' => 'required|integer|in:1,0', // Ensure status is either 1 or 0
            'media_categories' => 'required', // Ensure media categories are selected
        ];
        
        $messages = [
            'image_files.required' => 'Please upload at least one image.',
            'image_files.array' => 'Images must be uploaded as an array.',
            'image_files.*.mimes' => 'Each image must be of type: jpeg, png, jpg.',
            'image_files.*.max' => 'Each image must not exceed 2MB.',
            'image_title_english.required' => 'Please enter the English title.',
            'image_title_english.max' => 'The English title should not exceed 255 characters.',
            'research_centre.required' => 'Please select a research centre.',
            'status.required' => 'Please select a valid status.',
            'status.integer' => 'Status must be a valid number.',
            'status.in' => 'Invalid status selection.',
            'media_categories.required' => 'Please select at least one media category.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

        // Find the gallery by ID
        $gallery = MicroManagePhotoGallery::findOrFail($id);

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
        $gallery->media_categories = $request->input('media_categories');
        $gallery->research_centre = $request->input('research_centre');
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
            // Fetch the record using the ID
            $gallery = MicroManagePhotoGallery::findOrFail($id);

            // Check if the status is 1 (Inactive), and prevent deletion
            if ($gallery->status == 1) {
                return redirect()->route('micro-photo-gallery.index')
                    ->with('error', 'Active photo galleries cannot be deleted.');
            }

            // Delete the record if the status is not 1
            $gallery->delete();

            return redirect()->route('micro-photo-gallery.index')
                ->with('success', 'Photo Gallery deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return an error message
            return redirect()->route('micro-photo-gallery.index')
                ->with('error', 'Error deleting Photo Gallery: ' . $e->getMessage());
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

    public function fetchMediaCategories(Request $request)
    {
        $categories = DB::table('micro_media_categories')
            ->where('research_centre', $request->research_centre_id)
            ->where('status', 1)
            ->where('media_gallery', 1)
            ->select('id', 'name')
            ->get();
    
        return response()->json($categories);
    }
    












}