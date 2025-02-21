<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageVideoCenter;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class ManageVideoController extends Controller
{
    // List all media
    public function index()
    {
        // $media = ManageVideoCenter::all();
        
        // $mediaCategories = DB::table('manage_video_centers')
        // leftJoin()
        // ->where('page_status', 1)
        // ->get(); 
        // $mediaCategories = DB::table('manage_media_categories')
        // ->where('status', 1)
        // ->where('media_gallery', 'Video Gallery')
        // ->get(); 

        $media = DB::table('manage_video_centers')
        ->leftJoin('manage_media_categories as parent', 'manage_video_centers.category_name', '=', 'parent.id')
        // ->where('manage_video_centers.page_status',1)
        ->select('manage_video_centers.*', 'parent.name')
        ->get();
        return view('admin.video_gallery.index', compact('media'));
    }

    // Show the form for creating a new media
    public function create()
    {
        $media = DB::table('manage_media_categories')
        ->where('status', 1)
        ->where('media_gallery', 'Video Gallery')
        ->get(); 
        // print_r($media);die;
        return view('admin.video_gallery.create',compact('media'));
    }

    // // Store the newly created media
    // public function store(Request $request)
    // {
    //     // $request->validate([
    //  	$validated = $request->validate([
    //         'category_name' => 'required',
    //         'audio_title_en' => 'required',
    //         'audio_title_hi' => 'required',
    //         'video_upload' => 'nullable|url',
    //         'page_status' => 'required|integer|in:1,0',
    //     ]);


    //     if ($request->hasFile('video_upload')) {
	//         $filePath = $request->file('video_upload')->store('uploads/media', 'public');
	//         $validated['video_upload'] = $filePath; // Adjust to store the file path in the correct attribute
	//     }


    //     $video = ManageVideoCenter::create($validated);

    //     ManageAudit::create([
    //         'Module_Name' => 'Video Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('video_gallery.index')->with('success', 'Media added successfully.');
    // }

    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'video_upload' => 'required',
            'page_status' => 'required|integer|in:1,0',
        ];
        // Define custom validation messages
        $messages = [
            'category_name.required' => 'Please select a category name.',
            'audio_title_en.required' => 'Please enter the English title for the video.',
            'audio_title_hi.required' => 'Please enter the Hindi title for the video.',
            'video_upload.url' => 'Please provide a valid URL for the video.',
            'page_status.required' => 'Please select a status.',
            'page_status.integer' => 'Status must be an integer.',
            'page_status.in' => 'Status must be either 1 (Active) or 0 (Inactive).',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If Validation Fails
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  

        // Handle file upload if video is provided
        if ($request->hasFile('video_upload')) {
            $filePath = $request->file('video_upload')->store('uploads/media', 'public');
            $validated['video_upload'] = $filePath; // Store the file path
        }

        // Store the validated data in the database
        $video = ManageVideoCenter::create($validated);

        // Log the action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Video Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user (if available)
            'Updated_By' => null, // No update on creation
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // IP address of the requester
        ]);
        Cache::put('success_message', 'Video added successfully!', 1);
        // Redirect with a success message
        return redirect()->route('video_gallery.index');
    }


    // Show the form for editing the specified media
    public function edit($id)
    {
        $mediaCategories = DB::table('manage_media_categories')
        ->where('status', 1)
        ->where('media_gallery', 'Video Gallery')
        ->get(); 
        // print_r($mediaCategories);die; 
        $media = ManageVideoCenter::findOrFail($id);
        return view('admin.video_gallery.edit', compact('media','mediaCategories'));
    }

    // Update the specified media in the database
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'category_name' => 'required',
    //         'audio_title_en' => 'required',
    //         'audio_title_hi' => 'required',
    //         'video_upload' => 'nullable|url',
    //         'page_status' => 'required|integer|in:1,0',
    //     ]);

    //     $media = ManageVideoCenter::findOrFail($id);

    //     $data = [
    //         'category_name' => $request->category_name,
    //         'audio_title_en' => $request->audio_title_en,
    //         'audio_title_hi' => $request->audio_title_hi,
    //         'video_upload' => $request->video_upload,
    //         'page_status' => $request->page_status,
    //     ];

    //     if ($request->hasFile('video_upload')) {
    //         $data['video_upload'] = $request->file('video_upload')->store('uploads/media', 'public');
    //     }

    //     $video = $media->update($data);

    //     ManageAudit::create([
    //         'Module_Name' => 'Video Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('video_gallery.index')->with('success', 'Media updated successfully.');
    // }

    public function update(Request $request, $id)
    {
        // Define custom validation messages
        $rules = [
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'video_upload' => 'required',
            'page_status' => 'required|integer|in:1,0',
        ];
        // Define custom validation messages
        $messages = [
            'category_name.required' => 'Please select a category name.',
            'audio_title_en.required' => 'Please enter the English title for the video.',
            'audio_title_hi.required' => 'Please enter the Hindi title for the video.',
            'video_upload.url' => 'Please provide a valid URL for the video.',
            'page_status.required' => 'Please select a status.',
            'page_status.integer' => 'Status must be an integer.',
            'page_status.in' => 'Status must be either 1 (Active) or 0 (Inactive).',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // If Validation Fails
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }  

        // Find the existing media record to update
        $media = ManageVideoCenter::findOrFail($id);

        // Prepare the data array with incoming values
        $data = [
            'category_name' => $request->category_name,
            'audio_title_en' => $request->audio_title_en,
            'audio_title_hi' => $request->audio_title_hi,
            'page_status' => $request->page_status,
        ];

        // Handle file upload if a new video file is provided
        if ($request->hasFile('video_upload')) {
            // Store the new file and update the file path in the data array
            $data['video_upload'] = $request->file('video_upload')->store('uploads/media', 'public');
        } else if ($request->video_upload) {
            // If the video upload is a URL and not a file, store the URL
            $data['video_upload'] = $request->video_upload;
        }

        // Update the media record in the database
        $media->update($data);

        // Log the action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Video Module',  // Static value
            'Time_Stamp' => time(),  // Current timestamp
            'Created_By' => null,  // No change on creation
            'Updated_By' => auth()->id(),  // Store the authenticated user ID (if available)
            'Action_Type' => 'Update',  // Action type is 'Update'
            'IP_Address' => $request->ip(),  // Capture the request IP address
        ]);
        Cache::put('success_message', 'Media updated successfully!', 1);

        // Redirect with success message
        return redirect()->route('video_gallery.index');
    }


    // Delete the specified media
    public function destroy($id)
    {
        try {
            // Find the media record by ID
            $media = ManageVideoCenter::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($media->page_status == 1) {
            Cache::put('error_message', 'Active media cannot be deleted.!', 1);
                return redirect()->route('video_gallery.index');
            }

            // Delete the media record
            $media->delete();
            Cache::put('success_message', 'Media deleted successfully.', 1);

            // Redirect with a success message
            return redirect()->route('video_gallery.index');
        } catch (\Exception $e) {
            // Handle errors gracefully and return an error message
            Cache::put('error_message', 'Error deleting media: ' . $e->getMessage(), 1);

            return redirect()->route('video_gallery.index');
        }
    }

}
