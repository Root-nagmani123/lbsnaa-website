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

    // Store the newly created media
    public function store(Request $request)
    {
        // $request->validate([
     	$validated = $request->validate([
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'audio_title_hi' => 'required',
            'video_upload' => 'nullable|url',
            'page_status' => 'required|integer|in:1,2,3',
        ]);


        if ($request->hasFile('video_upload')) {
	        $filePath = $request->file('video_upload')->store('uploads/media', 'public');
	        $validated['video_upload'] = $filePath; // Adjust to store the file path in the correct attribute
	    }


        $video = ManageVideoCenter::create($validated);

        ManageAudit::create([
            'Module_Name' => 'Video Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($video->getAttributes()), // Save state as JSON
        ]);

        return redirect()->route('video_gallery.index')->with('success', 'Media added successfully.');
    }

    // Show the form for editing the specified media
    public function edit($id)
    {
        $media = ManageVideoCenter::findOrFail($id);
        return view('admin.video_gallery.edit', compact('media'));
    }

    // Update the specified media in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'audio_title_en' => 'required',
            'audio_title_hi' => 'required',
            'video_upload' => 'nullable|url',
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        $media = ManageVideoCenter::findOrFail($id);

        $data = [
            'category_name' => $request->category_name,
            'audio_title_en' => $request->audio_title_en,
            'audio_title_hi' => $request->audio_title_hi,
            'video_upload' => $request->video_upload,
            'page_status' => $request->page_status,
        ];

        if ($request->hasFile('video_upload')) {
            $data['video_upload'] = $request->file('video_upload')->store('uploads/media', 'public');
        }

        $video = $media->update($data);

        ManageAudit::create([
            'Module_Name' => 'Video Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($video), // Save state as JSON
        ]);

        return redirect()->route('video_gallery.index')->with('success', 'Media updated successfully.');
    }

    // Delete the specified media
    public function destroy($id)
    {
        $media = ManageVideoCenter::findOrFail($id);
        $media->delete();
        return redirect()->route('video_gallery.index')->with('success', 'Media deleted successfully.');
    }
}
