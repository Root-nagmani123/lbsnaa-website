<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManagePhotoGallery;
use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManagePhotoGalleryController extends Controller
{
    public function index()
    {
        $galleries = ManagePhotoGallery::all();
        return view('admin.manage_photo.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.manage_photo.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string',
            'image_title_english' => 'required|string',
            'image_title_hindi' => 'nullable|string',
            'related_news' => 'nullable|string',
            'related_training_program' => 'nullable|string',
            'related_events' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $gallery = ManagePhotoGallery::create($request->all());

        ManageAudit::create([
            'Module_Name' => 'Photo Gallery Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($gallery), // Save state as JSON
        ]);

        return redirect()->route('photo-gallery.index')->with('success', 'Gallery added successfully.');
    }

    public function edit(ManagePhotoGallery $gallery)
    {
        return view('manage_photo.edit', compact('gallery'));
    }

    public function update(Request $request, ManagePhotoGallery $gallery)
    {
        $request->validate([
            'category_name' => 'required|string',
            'image_title_english' => 'required|string',
            'image_title_hindi' => 'nullable|string',
            'related_news' => 'nullable|string',
            'related_training_program' => 'nullable|string',
            'related_events' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $gallery->update($request->all());

        ManageAudit::create([
            'Module_Name' => 'Photo Gallery Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($gallery), // Save state as JSON
        ]);

        return redirect()->route('photo-gallery.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy(ManagePhotoGallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('photo-gallery.index')->with('success', 'Gallery deleted successfully.');
    }


    public function searchCourses(Request $request)
    {
        $query = $request->query('query');
        $courses = Course::where('name', 'LIKE', '%' . $query . '%')->limit(10)->get(['id', 'name']);
        return response()->json($courses);
    }

}
