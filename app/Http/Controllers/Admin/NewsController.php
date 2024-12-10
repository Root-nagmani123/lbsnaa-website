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


use DOMDocument;



class NewsController extends Controller
{
    // List all news
    public function index()
    {
        $news = News::all();
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
        $request->validate(
            [
                'language' => 'required',
                'title' => 'required',
                'short_description' => 'required',
                'meta_title' => 'required',
                'description' => 'required',
                'meta_keywords' => 'required',
                'meta_description' => 'required',
                'multiple_images' => 'required',
                'end_date' => 'required',
                'main_image' => 'required|image|mimes:jpeg,png,jpg',
                'multiple_images.*' => 'image|mimes:jpeg,png,jpg',
                'start_date' => 'required|date',
                'status' =>'required|in:0,1',
            ],
            [
                'language.required' => 'The language field is required.',
                'title.required' => 'The title field is required.',
                'short_description.required' => 'The short description field is required.',
                'meta_title.required' => 'The meta title field is required.',
                'description.required' => 'The description field is required.',
                'main_image.required' => 'The main image is required.',
                'main_image.image' => 'The main image must be a valid image file.',
                'main_image.mimes' => 'The main image must be in jpeg, png, or jpg format.',
                'multiple_images.*.image' => 'Each uploaded file in multiple images must be a valid image.',
                'multiple_images.*.mimes' => 'Each uploaded file in multiple images must be in jpeg, png, or jpg format.',
                'start_date.required' => 'The start date is required.',
                'start_date.date' => 'The start date must be a valid date.',
                'end_date.required' => 'The end date is required.',
                'end_date.date' => 'The end date must be a valid date.',
                'end_date.after_or_equal' => 'The end date must be the same or after the start date.',
    
                'status' => 'Select valid status.',
            ]
        );
    
        // Rest of your code remains the same...
        $news = new News();
    
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->move(public_path('news_images'), time() . '_' . $request->file('main_image')->getClientOriginalName());
            $news->main_image = 'news_images/' . basename($mainImagePath);
        }
    
        if ($request->hasFile('multiple_images')) {
            $multipleImages = [];
            foreach ($request->file('multiple_images') as $image) {
                $imagePath = $image->move(public_path('news_images'), time() . '_' . $image->getClientOriginalName());
                $multipleImages[] = 'news_images/' . basename($imagePath);
            }
            $news->multiple_images = json_encode($multipleImages);
        }
    
        $description = $request->description;
    
        $dom = new DOMDocument();
        $dom->loadHTML($description, 9);
    
        $images = $dom->getElementsByTagName('img');
    
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
            $image_name = "/ckupload/" . time() . $key . '.png';
            file_put_contents(public_path() . $image_name, $data);
    
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $description = $dom->saveHTML();
    
        $news->language = $request->language;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keyword;
        $news->meta_description = $request->meta_description;
        $news->description = $description;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->status = $request->status;
    
        $news->title_slug = Str::slug($request->title, '-');
    
        $news->save();
    
        ManageAudit::create([
            'Module_Name' => 'News Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
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
            'language' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'end_date' => 'required',
            'start_date' => 'required|date',
            'status' =>'required|in:0,1',
        ],
        [
            'language.required' => 'The language field is required.',
            'title.required' => 'The title field is required.',
            'short_description.required' => 'The short description field is required.',
            'meta_title.required' => 'The meta title field is required.',
            'description.required' => 'The description field is required.',
            'main_image.required' => 'The main image is required.',
            'main_image.image' => 'The main image must be a valid image file.',
            'main_image.mimes' => 'The main image must be in jpeg, png, or jpg format.',
            'multiple_images.*.image' => 'Each uploaded file in multiple images must be a valid image.',
            'multiple_images.*.mimes' => 'Each uploaded file in multiple images must be in jpeg, png, or jpg format.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be the same or after the start date.',

            'status' => 'Select valid status.',
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


        $description = $request->description;

        $dom = new DOMDocument();
        $dom->loadHTML($description,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/ckupload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $description = $dom->saveHTML();


        // Update other news attributes
        $news->language = $request->language;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keywords;
        $news->meta_description = $request->meta_description;
        $news->description = $description;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->status = $request->status;
        $news->title_slug = Str::slug($request->title, '-');

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

    public function destroy($id)
    {
        $news = News::findOrFail($id);
    
        if ($news->status == 1) {
            return redirect()->route('admin.news.index')->with('error', 'Inactive news items cannot be deleted.');
        }
    
        $news->delete(); // Permanently deletes the record
    
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
    

 
}
