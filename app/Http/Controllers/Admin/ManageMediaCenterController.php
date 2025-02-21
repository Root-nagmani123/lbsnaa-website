<?php 
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\ManageMediaCenter;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
        // Validation rules
        $rules = [
            'category_name' => 'required|string',
            'audio_title_en' => 'required|string',
            'audio_title_hi' => 'nullable|string',
            'audio_upload' => 'required|mimes:mp3,mp4|max:5120',  // 5MB limit
            'page_status' => 'required|integer|in:1,0',
        ];
    
        // Custom validation messages
        $messages = [
            'category_name.required' => 'Select category name.',
            'audio_title_en.required' => 'Enter the English audio title.',
            'audio_upload.required' => 'Please upload an audio file.',
            'audio_upload.mimes' => 'Only MP3 and MP4 files are allowed.',
            'audio_upload.max' => 'The audio file size must not exceed 5MB.',
            'page_status.required' => 'Select the page status.',
            'page_status.in' => 'The page status must be either active (1) or inactive (0).',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }    
        

        // Validate request
        

        // Save the data 
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
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Audio created successfully!', 1);

        return redirect()->route('media-center.index');
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
        $rules = [
            'category_name' => 'required|string',
            'audio_title_en' => 'required|string',
            'audio_title_hi' => 'nullable|string',
            'audio_upload' => 'required|mimes:mp3,mp4|max:5120',  // 5MB limit
            'page_status' => 'required|integer|in:1,0',
        ];
    
        // Custom validation messages
        $messages = [
            'category_name.required' => 'Select category name.',
            'audio_title_en.required' => 'Enter the English audio title.',
            'audio_upload.required' => 'Please upload an audio file.',
            'audio_upload.mimes' => 'Only MP3 and MP4 files are allowed.',
            'audio_upload.max' => 'The audio file size must not exceed 5MB.',
            'page_status.required' => 'Select the page status.',
            'page_status.in' => 'The page status must be either active (1) or inactive (0).',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }    

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
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Audio updated successfully!', 1);

        return redirect()->route('media-center.index');
    }


    // Delete an audio
    public function destroy($id)
    {
        try {
            // Find the audio record by ID
            $audio = ManageMediaCenter::findOrFail($id);

            // Check if the status is 1 (Inactive), and if so, prevent deletion
            if ($audio->status == 1) {
                Cache::put('error_message', 'Active audios cannot be deleted!', 1);

                return redirect()->route('media-center.index');
            }
 
            // Check and delete the associated audio file
            if ($audio->audio_upload && file_exists(public_path('uploads/audios/' . $audio->audio_upload))) {
                unlink(public_path('uploads/audios/' . $audio->audio_upload));
                Log::info('Deleted audio file: ' . $audio->audio_upload);
            } else {
                Log::warning('Audio file not found: ' . $audio->audio_upload);
            }

            // Delete the audio record from the database
            $audio->delete();
            Cache::put('success_message', 'Audio deleted successfully!', 1);

            // Redirect with a success message
            return redirect()->route('media-center.index');
        } catch (\Exception $e) {
            // Handle errors gracefully and return an error message
            return redirect()->route('media-center.index')->with('error', 'Error deleting audio: ' . $e->getMessage());
        }
    }

    
}
