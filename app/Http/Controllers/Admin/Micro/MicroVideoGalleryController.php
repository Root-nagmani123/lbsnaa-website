<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroVideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;

class MicroVideoGalleryController extends Controller
{
    // Display a listing of the videos
    public function index()
    {
        $videos = MicroVideoGallery::all(); // Get all videos
        // Fetching active research centres where status == 1
        $researchCentres = DB::table('research_centres')
        ->where('status', 1) // Filter only active records
        ->pluck('research_centre_name', 'id');

        return view('admin.micro.manage_media_center.video_gallery.index', compact('videos','researchCentres'));
    }

    // Show the form for creating a new video
    public function create()
    {
        $categories = DB::table('micro_media_categories')
            ->where('status', 1)
            ->get(); // Retrieve records with status == 1 
        // dd($mediaCategories);
        $researchCentres = DB::table('research_centres')
            ->where('status', 1)  // Filter where status is 1
            ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names

        return view('admin.micro.manage_media_center.video_gallery.create', compact('categories','researchCentres'));
    }

    // Store a newly created video
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'video_title_en' => 'required',
            'video_title_hi' => 'nullable',
            'video_upload' => 'required|mimes:mp4|max:20480',
            'page_status' => 'required|in:1,0',
            'research_centre' => 'required',
        ]);
        // dd($request);
        $data = $request->all();

        // Handle video file upload
        if ($request->hasFile('video_upload')) {
            $data['video_upload'] = $request->file('video_upload')->store('videos', 'public');
        }

        MicroVideoGallery::create($data);

        MicroManageAudit::create([
            'Module_Name' => 'Video Gallery', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('micro-video-gallery.index')->with('success', 'Video added successfully.');
    }

    // Show the form for editing the video
    public function edit($id)
    {
        // Retrieve the video by its ID or fail if not found
        $video = MicroVideoGallery::findOrFail($id);

        // Retrieve all active categories with status == 1
        $categories = DB::table('micro_media_categories')
            ->where('status', '=', 1) // Explicitly specify the condition
            ->get();
        // dd($categories);
        $researchCentres = DB::table('research_centres')
            ->where('status', 1)  // Filter where status is 1
            ->pluck('research_centre_name', 'id');  // Replace 'research_centre_name' and 'id' with your actual column names

        // Return the edit view with video and categories data
        return view('admin.micro.manage_media_center.video_gallery.edit', compact('video', 'categories','researchCentres'));
    }


    // Update the specified video

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255', // Ensure category name is provided
            'video_title_en' => 'required|string|max:255', // English video title must be present
            'video_title_hi' => 'nullable|string|max:255', // Hindi video title is optional
            'video_upload' => 'nullable|mimes:mp4|max:20480', // Video upload must be an MP4 and max size 20MB (20480KB)
            'page_status' => 'required|in:1,0', // Must be 1 or 0
            'research_centre' => 'required',
        ], [    
            'category_name.required' => 'Please enter the category name.',
            'video_title_en.required' => 'Please provide the video title in English.',
            'video_upload.mimes' => 'The uploaded video must be an MP4 file.',
            'video_upload.max' => 'The video file size must not exceed 20MB.',
            'page_status.required' => 'Please select the page status.',
            'page_status.in' => 'The page status must be either active (1) or inactive (0).',
            'research_centre' => 'Please select research center',
        ]); 

        $video = MicroVideoGallery::findOrFail($id);
        $data = $request->all();

        // Handle video file upload
        if ($request->hasFile('video_upload')) {
            // Delete old file if exists
            if ($video->video_upload && file_exists(storage_path('app/public/' . $video->video_upload))) {
                unlink(storage_path('app/public/' . $video->video_upload));
            }
            $data['video_upload'] = $request->file('video_upload')->store('videos', 'public');
        }

        $video->update($data);

        MicroManageAudit::create([
            'Module_Name' => 'Video Gallery', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('micro-video-gallery.index')
                        ->with('success', 'Video updated successfully.');
    }


    public function show($id)
    {
        // Retrieve the video gallery by ID
        $video = MicroVideoGallery::findOrFail($id);  // This will find the video or throw a 404 if not found

        // Return the view with the video data
        return view('admin.micro-video-gallery.show', compact('video'));
    } 

    public function destroy($id)
    {
        // Find the video or fail with a 404
        $video = MicroVideoGallery::findOrFail($id);

        // Check if the video is active (status = 1)
        if ($video->page_status == 1) {
            return redirect()->route('micro-video-gallery.index')->with('error', 'Active videos cannot be deleted.');
        }

        // Delete the video file if it exists
        if ($video->video_upload && file_exists(storage_path('app/public/' . $video->video_upload))) {
            unlink(storage_path('app/public/' . $video->video_upload));
        }

        // Delete the video record from the database
        $video->delete();

        return redirect()->route('micro-video-gallery.index')->with('success', 'Video deleted successfully.');
    }

}