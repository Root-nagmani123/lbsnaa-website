<?php 
namespace App\Http\Controllers\Admin\Micro;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\Micro\MicroManageAudit;
use App\Models\Admin\Micro\Managenews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class ManageNewsController extends Controller
{
    // List all news
    public function index()
    {
        $news = Managenews::all(); // You can filter for active news only
        return view('admin.micro.managenews.index', compact('news'));
    }

    // Show create form
    public function create()
    {
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        return view('admin.micro.managenews.create',compact('researchCentres'));
    }

    // Store new news
    public function store(Request $request)
    {
        // $request->validate([
        //     'language' => 'required',
        //     'title' => 'required',
        //     'short_description' => 'required',
        //     'meta_title' => 'required',
        //     'description' => 'required',
        //     'main_image' => 'required|image|mimes:jpeg,png,jpg',
        //     'multiple_images.*' => 'image|mimes:jpeg,png,jpg',
        //     'start_date' => 'required|date',
        // ]);
        $news = new Managenews();

        if ($request->hasFile('main_image')) {
            // Store the new main image in public/uploads/Managenews_images
            $mainImagePath = $request->file('main_image')->move(public_path('Managenews_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'Managenews_images/' . basename($mainImagePath); // Save relative path
        }

        // Handle the multiple images upload
        if ($request->hasFile('multiple_images')) {
            $multipleImages = [];
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->move(public_path('Managenews_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'Managenews_images/' . basename($imagePath); // Save relative path
            }
            $news->multiple_images = json_encode($multipleImages); // Store as JSON string
        }

        // Set other news attributes
        $news->language = $request->language;
        $news->research_centreid = $request->research_centre;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keyword;
        $news->meta_description = $request->meta_description;
        $news->description = $request->description;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->status = $request->status;

        // $news->title_slug = Str::slug($request->title, '-');

        // Save the news instance
        $news = $news->save();


        MicroManageAudit::create([
            'Module_Name' => 'News Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('Managenews.index')->with('success', 'News created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $news = Managenews::findOrFail($id); // Ensure research_centreid is loaded correctly.
    
        $researchCentres = DB::table('research_centres')
            ->select('id', 'research_centre_name')
            ->pluck('research_centre_name', 'id')
            ->toArray();
    
        return view('admin.micro.managenews.edit', compact('news', 'researchCentres'));
    }
    

    // Update news
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'short_description' => 'required|string',
        //     'meta_title' => 'required|string|max:255',
        //     'meta_keyword' => 'nullable|string',
        //     'meta_description' => 'nullable|string',
        //     'description' => 'required|string',
            
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        //     'status' => 'required|boolean',
        // ]);

        $news = Managenews::findOrFail($id);

        // Handle the main image upload
        if ($request->hasFile('main_image')) {
            // Delete the old main image if it exists
            if (File::exists(public_path($news->main_image))) {
                File::delete(public_path($news->main_image));
            }

            // Store the new main image in public/uploads/Managenews_images
            $mainImagePath = $request->file('main_image')->move(public_path('Managenews_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'Managenews_images/' . basename($mainImagePath); // Save relative path
        }

        // Handle the multiple images upload
        if ($request->hasFile('multiple_images')) {
            // Decode the existing images if any
            $existingImages = json_decode($news->multiple_images, true) ?? [];

            // Delete existing images
            foreach ($existingImages as $existingImage) {
                if (File::exists(public_path($existingImage))) {
                    File::delete(public_path($existingImage));
                }
            }

            $multipleImages = [];
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->move(public_path('Managenews_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'Managenews_images/' . basename($imagePath); // Save relative path
            }
            $news->multiple_images = json_encode($multipleImages); // Store as JSON string
        }

        // Update other news attributes
        $news->language = $request->language;
        $news->research_centreid = $request->research_centre;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keywords;
        $news->meta_description = $request->meta_description;
        $news->description = $request->description;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->status = $request->status;
        // $news->title_slug = Str::slug($request->title, '-');

        // Save the updated news instance
        $news = $news->save();


        MicroManageAudit::create([
            'Module_Name' => 'News Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('Managenews.index')->with('success', 'News updated successfully.');
    }

    // Soft delete (mark as is_deleted)
    public function destroy($id)
    {
        $news = Managenews::findOrFail($id);
        $news->delete();

        return redirect()->route('Managenews.index')->with('success', 'News deleted successfully.');
    }
}
