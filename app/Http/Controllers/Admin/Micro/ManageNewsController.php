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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class ManageNewsController extends Controller
{
    // List all news
    public function index()
    {
        // $news = Managenews::all(); // You can filter for active news only

        $news = DB::table('managenews')
            ->join('research_centres', 'managenews.research_centreid', '=', 'research_centres.id') // Join on research_centre_id
            ->select('managenews.*', 'research_centres.research_centre_name as rese_name') // Select columns from both tables
            ->get();

        return view('admin.micro.managenews.index', compact('news'));
    }

    // Show create form
    public function create()
    {
        // Fetch only research centres with status == 1
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Filter based on status
            ->pluck('research_centre_name', 'id'); // Replace 'research_centre_name' and 'id' with actual column names

        return view('admin.micro.managenews.create', compact('researchCentres'));
    }


    // Store new news
    public function store(Request $request)
    {
        // Validation    
        $rules = [
            'language' => 'required',
            'research_centre' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Main image max 5MB
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date', // End date must be after or equal to start date
            'multiple_images' => 'required|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg|max:10240', // Each file max 10MB
        ];
        
        $messages = [
            'language.required' => 'Please select a language.',
            'research_centre.required' => 'Please select a research centre.',
            'title.required' => 'The title field is required.',
            'short_description.required' => 'The short description is required.',
            'meta_title.required' => 'Please enter a meta title.',
            'description.required' => 'Please fill in the description field.',
            'main_image.required' => 'Please upload the main image (max 5MB).',
            'main_image.image' => 'The main image must be an image file.',
            'main_image.mimes' => 'The main image must be a file of type: jpeg, png, jpg.',
            'main_image.max' => 'The main image must not exceed 5MB in size.',
            'status.required' => 'Please select the status.',
            'start_date.required' => 'Please provide the start date.',
            'end_date.required' => 'Please provide the end date.',
            'multiple_images.required' => 'Please upload at least one image.',
            'multiple_images.array' => 'The multiple images field must be an array.',
            'multiple_images.*.image' => 'Each uploaded file must be an image.',
            'multiple_images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg.',
            'multiple_images.*.max' => 'Each image must not exceed 10MB in size.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();
        
    
        // Create a new news instance
        $news = new Managenews();
    
        // Handle main image upload
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
    
        // Convert dates to 'YYYY-MM-DD' format using Carbon
        // After validation
        $news->start_date = Carbon::parse($request->start_date)->format('Y-m-d'); // Ensure correct date format for MySQL
        $news->end_date = Carbon::parse($request->end_date)->format('Y-m-d'); // Ensure correct date format for MySQL
    
        // Assign other attributes
        $news->language = $request->language;
        $news->research_centreid = $request->research_centre;
        $news->title = $request->title;
        $news->short_description = $request->short_description;
        $news->meta_title = $request->meta_title;
        $news->meta_keywords = $request->meta_keyword ?? ''; // Optional field
        $news->meta_description = $request->meta_description ?? ''; // Optional field
        $news->description = $request->description;
        $news->status = $request->status;
    
        // Save the news record to the database
        $news->save();
    
        // Create an audit log entry
        MicroManageAudit::create([
            'Module_Name' => 'News Module',
            'Time_Stamp' => time(),
            'Created_By' => null, // Use authenticated user ID if available
            'Updated_By' => null, // No update on creation
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
    
        // Redirect with success message
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
        
        $rules = [
            'language' => 'required',
            'research_centre' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Main image max 5MB
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date', // End date must be after or equal to start date
            'multiple_images' => 'required|array',
            'multiple_images.*' => 'image|mimes:jpeg,png,jpg|max:10240', // Each file max 10MB
        ];
        
        $messages = [
            'language.required' => 'Please select a language.',
            'research_centre.required' => 'Please select a research centre.',
            'title.required' => 'The title field is required.',
            'short_description.required' => 'The short description is required.',
            'meta_title.required' => 'Please enter a meta title.',
            'description.required' => 'Please fill in the description field.',
            'main_image.required' => 'Please upload the main image (max 5MB).',
            'main_image.image' => 'The main image must be an image file.',
            'main_image.mimes' => 'The main image must be a file of type: jpeg, png, jpg.',
            'main_image.max' => 'The main image must not exceed 5MB in size.',
            'status.required' => 'Please select the status.',
            'start_date.required' => 'Please provide the start date.',
            'end_date.required' => 'Please provide the end date.',
            'multiple_images.required' => 'Please upload at least one image.',
            'multiple_images.array' => 'The multiple images field must be an array.',
            'multiple_images.*.image' => 'Each uploaded file must be an image.',
            'multiple_images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg.',
            'multiple_images.*.max' => 'Each image must not exceed 10MB in size.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

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
            return redirect()->route('Managenews.index')->with('error', 'Active news cannot be deleted.');
        }

        // Soft delete the news item
        $news->delete();

        // Redirect with success message
        return redirect()->route('Managenews.index')->with('success', 'News deleted successfully.');
    }

}
