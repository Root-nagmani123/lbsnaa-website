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
        // $categories = DB::table('micro_media_categories')
        //     ->where('status', 1)
        //     ->where('media_gallery', 2)
        //     ->get(); // Retrieve records with status == 1 
        // dd($mediaCategories);
        $categories = DB::table('micro_media_categories')
            ->join('research_centres', 'micro_media_categories.research_centre', '=', 'research_centres.id')
            ->where('micro_media_categories.status', 1)
            ->where('micro_media_categories.media_gallery', 2)
            ->select('micro_media_categories.id', 'micro_media_categories.name', 'research_centres.research_centre_name as centre_name')
            ->get();


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
            'video_upload' => 'required|url|regex:/^https:\/\/(www\.)?youtube\.com\/.+$/',
            'page_status' => 'required|in:1,0',
            'research_centre' => 'required',
        ], [
            'category_name.required' => 'Please enter a category name.',
            'video_title_en.required' => 'Please provide a title for the video in English.',
            'video_title_hi.required' => 'Please provide a title for the video in Hindi if applicable.',
            'video_upload.required' => 'Please provide a YouTube video URL.',
            'video_upload.url' => 'Please provide a valid YouTube video URL.',
            'video_upload.regex' => 'The video URL must be a valid YouTube link starting with "https://www.youtube.com".',
            'page_status.required' => 'Please select the page status.',
            'page_status.in' => 'The page status must be either 1 (active) or 0 (inactive).',
            'research_centre.required' => 'Please select a research centre.',
        ]);

        // Store the request data
        $data = $request->all();

        // Handle video URL (No need for file upload here)
        // Assuming you want to store the video URL instead of uploading the video

        // Create new record
        MicroVideoGallery::create($data);

        // Log the audit details
        MicroManageAudit::create([
            'Module_Name' => 'Video Gallery', 
            'Time_Stamp' => time(),
            'Created_By' => null, 
            'Updated_By' => null, 
            'Action_Type' => 'Insert', 
            'IP_Address' => $request->ip(),
        ]);

        // Redirect with success message 
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
            ->where('media_gallery', 2)
            ->get();
            // Fetch all research centres for dropdown
        $researchCentres = DB::table('micro_video_galleries as mvg')
        ->join('research_centres as rc', 'mvg.research_centre', '=', 'rc.id')
        ->where('mvg.id', $id)
        ->pluck('rc.research_centre_name', 'rc.id');

        // Return the edit view with video and categories data
        return view('admin.micro.manage_media_center.video_gallery.edit', compact('video', 'categories','researchCentres'));
    }


    // Update the specified video

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'video_title_en' => 'required',
            'video_title_hi' => 'nullable',
            'video_upload' => 'required|url|regex:/^https:\/\/(www\.)?youtube\.com\/.+$/',
            'page_status' => 'required|in:1,0',
            'research_centre' => 'required',
        ], [
            'category_name.required' => 'Please enter a category name.',
            'video_title_en.required' => 'Please provide a title for the video in English.',
            'video_title_hi.required' => 'Please provide a title for the video in Hindi if applicable.',
            'video_upload.required' => 'Please provide a YouTube video URL.',
            'video_upload.url' => 'Please provide a valid YouTube video URL.',
            'video_upload.regex' => 'The video URL must be a valid YouTube link starting with "https://www.youtube.com".',
            'page_status.required' => 'Please select the page status.',
            'page_status.in' => 'The page status must be either 1 (active) or 0 (inactive).',
            'research_centre.required' => 'Please select a research centre.',
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

    public function getResearchCentres(Request $request)
    {
        // Validate request
        $request->validate([
            'category_id' => 'required|integer',
        ]);

        $categoryId = $request->category_id;

         // Fetch research centres based on category_id using JOIN
        $researchCentres = DB::table('micro_media_categories as mmc')
        ->join('research_centres as rc', 'mmc.research_centre', '=', 'rc.id') // JOIN दोनों टेबल्स को
        ->where('mmc.id', $categoryId) // 'category_id' के आधार पर शोध सेंटर्स प्राप्त करें
        ->pluck('rc.research_centre_name', 'rc.id'); // research_centre_name और id प्राप्त करें

        if ($researchCentres->isEmpty()) {
            return response()->json([
                'data' => [],
                'message' => "No research centres found"
            ], 200);
        }

        return response()->json([
            'data' => $researchCentres,
            'message' => "Research centres fetched successfully"
        ], 200);
    }

    public function fetchMediaCategoriesvideo(Request $request)
    {
        $categories = DB::table('micro_media_categories')
            ->where('research_centre', $request->research_centre_id)
            ->where('status', 1)
            ->where('media_gallery', 2)
            ->select('id', 'name')
            ->get();
        // dd($categories);
        return response()->json($categories);
    }
    


}