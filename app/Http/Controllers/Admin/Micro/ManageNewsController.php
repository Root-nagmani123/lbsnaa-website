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
use Carbon\Carbon;


class ManageNewsController extends Controller
{
    // List all news
    public function index()
    {
        $news = Managenews::all(); // You can filter for active news only
        return view('admin.micro.managenews.index', compact('news'));
    }

    // Show create form
    // public function create()
    // {
    //     $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
    //     return view('admin.micro.managenews.create',compact('researchCentres'));
    // }

    public function create()
    {
        // Fetch only research centres with status == 1
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Filter based on status
            ->pluck('research_centre_name', 'id'); // Replace 'research_centre_name' and 'id' with actual column names

        return view('admin.micro.managenews.create', compact('researchCentres'));
    }


    // // Store new news
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'language' => 'required',
    //         'research_centre' => 'required',
    //         'title' => 'required',
    //         'short_description' => 'required',
    //         'meta_title' => 'required',
    //         'description' => 'required',
    //         'main_image' => 'required|image|mimes:jpeg,png,jpg',
    //         'start_date' => 'required',
    //         'status' => 'required',
    //         'end_date' => 'required',

    //         'multiple_images' => 'required|array',  // Ensure multiple files are uploaded
    //         'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each file is an image
    //     ]);
    //     $news = new Managenews();

    //     if ($request->hasFile('main_image')) {
    //         // Store the new main image in public/uploads/Managenews_images
    //         $mainImagePath = $request->file('main_image')->move(public_path('Managenews_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
    //         $news->main_image = 'Managenews_images/' . basename($mainImagePath); // Save relative path
    //     }

    //     // Handle the multiple images upload
    //     if ($request->hasFile('multiple_images')) {
    //         $multipleImages = [];
    //         foreach ($request->file('multiple_images') as $image) {
    //             $imagePath = $image->move(public_path('Managenews_images'), time() . '_' . $image->getClientOriginalName());
    //             $multipleImages[] = 'Managenews_images/' . basename($imagePath); // Save relative path
    //         }
    //         $news->multiple_images = json_encode($multipleImages); // Store as JSON string
    //     }

    //     // Set other news attributes
    //     $news->language = $request->language;
    //     $news->research_centreid = $request->research_centre;
    //     $news->title = $request->title;
    //     $news->short_description = $request->short_description;
    //     $news->meta_title = $request->meta_title;
    //     $news->meta_keywords = $request->meta_keyword;
    //     $news->meta_description = $request->meta_description;
    //     $news->description = $request->description;
    //     $news->start_date = $request->start_date;
    //     $news->end_date = $request->end_date;
    //     $news->status = $request->status;

    //     // $news->title_slug = Str::slug($request->title, '-');

    //     // Save the news instance
    //     $news = $news->save();


    //     MicroManageAudit::create([
    //         'Module_Name' => 'News Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('Managenews.index')->with('success', 'News created successfully.');
    // }

    

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'research_centre' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'start_date' => 'required|date_format:d-m-Y', // Expecting DD-MM-YYYY format
            'status' => 'required',
            'end_date' => 'required|date_format:d-m-Y', // Expecting DD-MM-YYYY format

            'multiple_images' => 'required|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each file is an image
        ]);

        $news = new Managenews();

        // Handle file upload for main image
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->move(public_path('Managenews_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'Managenews_images/' . basename($mainImagePath); // Save relative path
        }

        // Handle multiple images upload
        if ($request->hasFile('multiple_images')) {
            $multipleImages = [];
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->move(public_path('Managenews_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'Managenews_images/' . basename($imagePath); // Save relative path
            }
            $news->multiple_images = json_encode($multipleImages); // Store as JSON string
        }

        // Convert start_date and end_date to YYYY-MM-DD format using Carbon
        $news->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        $news->end_date = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');

        // Set other news attributes
        $news->language = $request->language;
        $news->research_centreid = $request->research_centre;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keyword;
        $news->meta_description = $request->meta_description;
        $news->description = $request->description;
        $news->status = $request->status;

        // Save the news instance
        $news->save();

        // Create a new audit record
        MicroManageAudit::create([
            'Module_Name' => 'News Module',
            'Time_Stamp' => time(),
            'Created_By' => null, // Set to authenticated user ID if needed
            'Updated_By' => null, // No update on creation
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
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
        $request->validate([
            'language' => 'required',
            'research_centre' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'start_date' => 'required|date_format:d-m-Y', // Expecting DD-MM-YYYY format
            'status' => 'required',
            'end_date' => 'required|date_format:d-m-Y', // Expecting DD-MM-YYYY format

            'multiple_images' => 'required|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each file is an image
        ]);

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

    public function destroy($id)
    {
        // Find the news item
        $news = Managenews::findOrFail($id);

        // Check if the status is 1 (Inactive) and prevent deletion
        if ($news->status == 1) {
            return redirect()->route('Managenews.index')->with('error', 'Inactive news cannot be deleted.');
        }

        // Soft delete the news item
        $news->delete();

        // Redirect with success message
        return redirect()->route('Managenews.index')->with('success', 'News deleted successfully.');
    }

}
