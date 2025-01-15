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
                'end_date' => 'required|date|after_or_equal:start_date',
                'main_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max size 5MB for main image
                'multiple_images.*' => 'image|mimes:jpeg,png,jpg|max:10240', // max 10MB for each file
                'start_date' => 'required|date',
                'status' => 'required|in:0,1',
            ],
            [
                'language.required' => 'Please select a language.',
                'title.required' => 'Please enter the title.',
                'short_description.required' => 'Please enter a short description.',
                'meta_title.required' => 'Please enter a meta title.',
                'description.required' => 'Please enter the description.',
                'meta_keywords.required' => 'Please enter meta keywords.',
                'meta_description.required' => 'Please enter a meta description.',
                'main_image.required' => 'Please upload a main image. MAX 5MB',
                'main_image.image' => 'The main image must be a valid image file.',
                'main_image.mimes' => 'The main image must be in jpeg, png, or jpg format.',
                'main_image.max' => 'The main image must not exceed 5 MB.',
                'multiple_images.required' => 'Please upload at least one image. MAX 10MB',
                'multiple_images.*.image' => 'Each uploaded file in multiple images must be a valid image.',
                'multiple_images.*.mimes' => 'Each uploaded file in multiple images must be in jpeg, png, or jpg format.',
                'multiple_images.*.max' => 'Each image must not exceed 5 MB.',
                'multiple_images.*.min' => 'Each image must be at least 2 MB.',
                'start_date.required' => 'Please enter the start date.',
                'start_date.date' => 'The start date must be a valid date.',
                'end_date.required' => 'Please enter the end date.',
                'end_date.date' => 'The end date must be a valid date.',
                'end_date.after_or_equal' => 'The end date must be the same or after the start date.',
                'status.required' => 'Please select the status.',
                'status.in' => 'Please select a valid status: active or inactive.',
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
 
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true); // HTML parsing errors को suppress करने के लिए
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
    
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
        $news->meta_keywords = $request->meta_keywords;
        $news->meta_description = $request->meta_description;
        $news->description = $description;
        $news->start_date = $request->start_date;
        $news->end_date = $request->end_date;
        $news->status = $request->status;
    if($request->language == 1){
        $news->title_slug = Str::slug($request->title, '-');
    }else if($request->language == 2){
        $news->title_slug = Str::slug($request->meta_title, '-');
    }
       
    
        $news->save();
    
        ManageAudit::create([
            'Module_Name' => 'News Module',
            'Time_Stamp' => time(),
            // 'Time_Stamp' => date('Y-m-d H:i:s', time()),
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
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_date' => 'required|date',
            'status' => 'required|in:0,1',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg|max:10240', // max 10MB for each file
        ], [
            // Custom validation messages
            'language.required' => 'Please select a language.',
            'title.required' => 'Please enter the title.',
            'short_description.required' => 'Please enter a short description.',
            'meta_title.required' => 'Please enter a meta title.',
            'description.required' => 'Please enter the description.',
            'meta_keywords.required' => 'Please enter meta keywords.',
            'meta_description.required' => 'Please enter a meta description.',
            'main_image.required' => 'Please upload a main image. MAX 5MB',
            'main_image.image' => 'Please ensure the main image is a valid image file.',
            'main_image.mimes' => 'The main image must be in jpeg, png, or jpg format.',
            'main_image.max' => 'The main image must not exceed 2MB.',
            'multiple_images.*.image' => 'Please ensure each file is a valid image.',
            'multiple_images.*.mimes' => 'Each image must be in jpeg, png, or jpg format.',
            'multiple_images.*.max' => 'Each image must not exceed 2MB.',
            'start_date.required' => 'Please enter the start date.',
            'start_date.date' => 'Please ensure the start date is a valid date.',
            'end_date.required' => 'Please enter the end date.',
            'end_date.date' => 'Please ensure the end date is a valid date.',
            'end_date.after_or_equal' => 'The end date must be the same or later than the start date.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'Please select either active or inactive as the status.',
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

        // DOMDocument को UTF-8 में इनिशियलाइज़ करें
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true); // HTML parsing errors को suppress करने के लिए
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8')); 
        
        $images = $dom->getElementsByTagName('img');
        
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
        
            // Check if src contains "data:" prefix and ";base64," to ensure it's a valid data URI
            if (str_starts_with($src, 'data:') && str_contains($src, ';base64,')) {
                $srcParts = explode(';', $src);
                
                // Extract and decode the base64 data
                if (isset($srcParts[1]) && str_contains($srcParts[1], ',')) {
                    $dataParts = explode(',', $srcParts[1]);
                    $base64Data = $dataParts[1] ?? '';
                    $data = base64_decode($base64Data);
        
                    if ($data !== false) {
                        $image_name = "/ckupload/" . time() . $key . '.png';
                        file_put_contents(public_path() . $image_name, $data);
        
                        // Update the src attribute to the new file path
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $image_name);
                    }
                }
            }
        }
        
        // Save the modified HTML with UTF-8
        $description = $dom->saveHTML();
        
        // Debug the output
        // echo $description;die;
        
        // $description = $dom->saveHTML();


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
       
        if($request->language == 1){
            $news->title_slug = Str::slug($request->title, '-');
        }else if($request->language == 2){
            $news->title_slug = Str::slug($request->meta_title, '-');
        }

        // Save the updated news instance
        $news = $news->save();


        ManageAudit::create([
            'Module_Name' => 'News Module', // Static value
            // 'Time_Stamp' => time(), // Current timestamp
            'Time_Stamp' => time(),
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
            return redirect()->route('admin.news.index')->with('error', 'Active news items cannot be deleted.');
        }
    
        $news->delete(); // Permanently deletes the record
    
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
    

 
}
