<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageVideoCenter;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageVideoController extends Controller
{
    // List all media
    public function index()
    {
        $media = ManageVideoCenter::all();
        return view('admin.video_gallery.index', compact('media'));
    }

    // Show the form for creating a new media
    public function create()
    {
        return view('admin.video_gallery.create');
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

        // Validate the request with custom messages
        $validated = $request->validate([
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'video_upload' => 'required',
            'page_status' => 'required|integer|in:1,0',
        ], $messages);

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

        // Redirect with a success message
        return redirect()->route('video_gallery.index')->with('success', 'Video added successfully.');
    }


    // Show the form for editing the specified media
    public function edit($id)
    {
        $media = ManageVideoCenter::findOrFail($id);
        return view('admin.video_gallery.edit', compact('media'));
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
        $messages = [
            'category_name.required' => 'Please select a category name.',
            'audio_title_en.required' => 'Please enter the English title for the audio.',
            'audio_title_hi.required' => 'Please enter the Hindi title for the audio.',
            'video_upload.url' => 'Please provide a valid URL for the video.',
            'page_status.required' => 'Please select a status.',
            'page_status.integer' => 'Status must be an integer.',
            'page_status.in' => 'Status must be either 1 (Active) or 0 (Inactive).',
        ];

        // Validate the request with custom messages
        $validated = $request->validate([
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'audio_title_hi' => 'required',
            'video_upload' => 'required',  // Check if video_upload is a valid URL
            'page_status' => 'required|integer|in:1,0', // Ensure valid page status
        ], $messages);

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

        // Redirect with success message
        return redirect()->route('video_gallery.index')->with('success', 'Media updated successfully.');
    }


    // // Delete the specified media
    // public function destroy($id)
    // {
    //     $media = ManageVideoCenter::findOrFail($id);
    //     $media->delete();
    //     return redirect()->route('video_gallery.index')->with('success', 'Media deleted successfully.');
    // }

    // Delete the specified media
    public function destroy($id)
    {
        try {
            // Find the media record by ID
            $media = ManageVideoCenter::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($media->page_status == 1) {
                return redirect()->route('video_gallery.index')->with('error', 'Inactive media cannot be deleted.');
            }

            // Delete the media record
            $media->delete();

            // Redirect with a success message
            return redirect()->route('video_gallery.index')->with('success', 'Media deleted successfully.');
        } catch (\Exception $e) {
            // Handle errors gracefully and return an error message
            return redirect()->route('video_gallery.index')->with('error', 'Error deleting media: ' . $e->getMessage());
        }
    }

}
