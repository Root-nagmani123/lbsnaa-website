<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class NewsController extends Controller
{
    // List all news
    public function index()
    {
        $news = News::where('status', 1)->get(); // You can filter for active news only
        return view('admin.news.index', compact('news'));
    }

    // Show create form
    public function create()
    {
        return view('admin.news.create');
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
        $news = new News();

        if ($request->hasFile('main_image')) {
            // Store the new main image in public/uploads/news_images
            $mainImagePath = $request->file('main_image')->move(public_path('news_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'news_images/' . basename($mainImagePath); // Save relative path
        }

        // Handle the multiple images upload
        if ($request->hasFile('multiple_images')) {
            $multipleImages = [];
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->move(public_path('news_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'news_images/' . basename($imagePath); // Save relative path
            }
            $news->multiple_images = json_encode($multipleImages); // Store as JSON string
        }

        // Set other news attributes
        $news->language = $request->language;
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


        ManageAudit::create([
            'Module_Name' => 'News Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    // Update news
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'description' => 'required|string',
            
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|boolean',
        ]);

        $news = News::findOrFail($id);

        // Handle the main image upload
        if ($request->hasFile('main_image')) {
            // Delete the old main image if it exists
            if (File::exists(public_path($news->main_image))) {
                File::delete(public_path($news->main_image));
            }

            // Store the new main image in public/uploads/news_images
            $mainImagePath = $request->file('main_image')->move(public_path('news_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'news_images/' . basename($mainImagePath); // Save relative path
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
                $imagePath = $image->move(public_path('news_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'news_images/' . basename($imagePath); // Save relative path
            }
            $news->multiple_images = json_encode($multipleImages); // Store as JSON string
        }

        // Update other news attributes
        $news->language = $request->language;
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


        ManageAudit::create([
            'Module_Name' => 'News Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($news), // Save state as JSON
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    // Soft delete (mark as is_deleted)
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->is_deleted = 1;
        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
