<?php 
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageMediaCenter;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageMediaCenterController extends Controller
{
    // Show all audio records
    public function index()
    {
        $audios = ManageMediaCenter::all();
        return view('admin.manage_mediacenter.index', compact('audios'));
    }

    // Show form for adding a new audio
    public function create()
    {
        return view('admin.manage_mediacenter.create');
    }

    // Store the newly created audio
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string',
            'audio_title_en' => 'required|string',
            'audio_title_hi' => 'nullable|string',
            'audio_upload' => 'required|mimes:mp3,mp4|max:2048',  // Accept .mp4 and audio formats
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        $audio = new ManageMediaCenter();
        $audio->category_name = $request->category_name;
        $audio->audio_title_en = $request->audio_title_en;
        $audio->audio_title_hi = $request->audio_title_hi;
        
        // Handle file upload
        if ($request->hasFile('audio_upload')) {
            $filename = time() . '.' . $request->audio_upload->extension();
            $request->audio_upload->move(public_path('uploads/audios'), $filename);
            $audio->audio_upload = $filename;
        }

        $audio->page_status = $request->page_status;
        $audio->save();

        ManageAudit::create([
            'Module_Name' => 'Media Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($audio), // Save state as JSON
        ]);

        return redirect()->route('media-center.index')->with('success', 'Audio created successfully');
    }

    // Edit an existing audio
    public function edit($id)
    {
        $audio = ManageMediaCenter::findOrFail($id);
        return view('admin.manage_mediacenter.edit', compact('audio'));
    }

    // Update the audio record
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string',
            'audio_title_en' => 'required|string',
            'audio_title_hi' => 'nullable|string',
            'audio_upload' => 'nullable|mimes:mp3,mp4|max:2048',  // Accept .mp4 and audio formats
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        $audio = ManageMediaCenter::findOrFail($id);
        $audio->category_name = $request->category_name;
        $audio->audio_title_en = $request->audio_title_en;
        $audio->audio_title_hi = $request->audio_title_hi;

        // Handle file upload if a new file is provided
        if ($request->hasFile('audio_upload')) {
            $filename = time() . '.' . $request->audio_upload->extension();
            $request->audio_upload->move(public_path('uploads/audios'), $filename);
            $audio->audio_upload = $filename;
        }

        $audio->page_status = $request->page_status;
        $audio->save();

        ManageAudit::create([
            'Module_Name' => 'Media Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($audio), // Save state as JSON
        ]);

        return redirect()->route('media-center.index')->with('success', 'Audio updated successfully');
    }

    // Delete an audio
    public function destroy($id)
    {
        $audio = ManageMediaCenter::findOrFail($id);
        if ($audio->audio_upload && file_exists(public_path('uploads/audios/' . $audio->audio_upload))) {
            unlink(public_path('uploads/audios/' . $audio->audio_upload));
        }
        $audio->delete();
        return redirect()->route('media-center.index')->with('success', 'Audio deleted successfully');
    }
    
}
