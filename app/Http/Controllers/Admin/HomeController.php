<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Slider;
use App\Models\Admin\HomeFooterImage;
use App\Models\Admin\QuickLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // List all sliders
    public function slider_list()
    {
        $sliders = Slider::where('is_deleted', 0)
        ->orderBy('id', 'desc')
        ->get();
    
        return view('admin.home.slider_list', compact('sliders'));
    }

    // Show the form for creating a new slider
    public function slider_create()
    {
        return view('admin.home.slider_create');
    }


    public function slider_store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'text' => 'required',
            'description' => 'required',
            'status' => 'required|in:0,1', // Status should be either 0 or 1
        ]);

        // Default value for 'language' if it's not provided
        // $language = $request->language ?? '1';

        // Save image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('slider-images'), $imageName);

        // Insert the validated data into the database
        DB::table('sliders')->insert([
            'language' => $request['language'],
            'image' => $imageName,
            'text' => $request['text'] ?? '', // Default to empty string if color_theme is not provided
            'is_deleted' => 0, // Default to 0 if parent_id is not provided
            'description' => $request['description'] ?? '', // Default to empty string if description is not provided
            'status' => $request['status'],
            
        ]);

        ManageAudit::create([
            'Module_Name' => 'Slider', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.slider_list')->with('success', 'Slider created successfully.');
    }
 

    // Show the form for editing an existing slider
    public function slider_edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.home.slider_edit', compact('slider'));
    }

    // Update an existing slider in the database
    public function slider_update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'text' => 'required',
            'description' => 'required',
            'status' => 'required|in:0,1', // Status should be either 0 or 1
        ]);

        $slider = Slider::findOrFail($id);

        // If image is updated, save the new image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('slider-images'), $imageName);
            $slider->image = $imageName;
        }

        // Update slider data
        $slider->language = $request->language;
        $slider->text = $request->text;
        $slider->description = $request->description;
        $slider->status = $request->status ?? 0;

        $slider->save();

        ManageAudit::create([
            'Module_Name' => 'Section Category', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.slider_list')->with('success', 'Slider updated successfully.');
    }

    // Delete a slider (soft delete by setting is_deleted = 1)
    public function slider_destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->is_deleted = 1;
        $slider->save();

        return redirect()->route('admin.slider_list')->with('success', 'Slider deleted successfully.');
    }
    
    public function slider_toggle_status(Request $request, $id)
{
    $slider = Slider::findOrFail($id);
    $slider->status = !$slider->status; // Toggle status
    $slider->save();

    return response()->json(['success' => 'Slider status updated successfully.']);
}

public function footer_image_list()
{
    $footerImages = HomeFooterImage::whereNull('deleted_on')->get();
    return view('admin.home.footer_image_list', compact('footerImages'));
}

// Show the form for creating a new footer image
public function footer_image_create()
{
    return view('admin.home.footer_image_create');
}

// // Store a newly created footer image in the database
// public function footer_image_store(Request $request)
// {
//     $request->validate([
//         'language' => 'required',
//         'title' => 'required',
//         'link' => 'required',
//         'description' => 'required',
//         'image' => 'required|image|mimes:jpeg,png,jpg,gif',
//         'status' => 'required|in:0,1',
//     ]);
//     // dd($request);
//     // Save image
//     $imageName = time() . '.' . $request->image->extension();
//     $request->image->move(public_path('footer-images'), $imageName);
    
//     // Create footer image
//     HomeFooterImage::create([
//         // dd($request),
//         'language' => $request->language,
//         'title' => $request->title,
//         'link' => $request->link,
//         'description' => $request->description,
//         'image' => $imageName,
//         'status' => $request->status ?? 0,
//         'deleted_on' => null,
//     ]);

//     ManageAudit::create([
//         'Module_Name' => 'Footer Image', // Static value
//         'Time_Stamp' => time(), // Current timestamp
//         'Created_By' => null, // ID of the authenticated user
//         'Updated_By' => null, // No update on creation, so leave null
//         'Action_Type' => 'Insert', // Static value
//         'IP_Address' => $request->ip(), // Get IP address from request
//     ]);

//     return redirect()->route('admin.footer_images.index')->with('success', 'Footer image added successfully.');
// }

public function footer_image_store(Request $request)
{
    $request->validate([
        'language' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'link' => 'required|url',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:0,1',
    ]);

        // Save image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('footer-images'), $imageName);

        // Insert the validated data into the database
        DB::table('home_footer_images')->insert([
            'language' => $request->language,
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status,
            'deleted_on' => null, // Assuming 'is_deleted' is a field in your table
        ]);

        // Audit entry
        ManageAudit::create([
            'Module_Name' => 'Footer Image', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.footer_images.index')->with('success', 'Footer image added successfully.');
    
}

// Show the form for editing an existing footer image
public function footer_image_edit($id)
{
    $footerImage = HomeFooterImage::findOrFail($id);
    // dd($footerImage);
    return view('admin.home.footer_image_edit', compact('footerImage'));
}

// Update an existing footer image in the database
public function footer_image_update(Request $request, $id)
{
    $request->validate([ 
        'language' => 'required',
        'title' => 'required',
        'link' => 'required',
        'description' => 'required',
        'status' => 'required|in:0,1',
    ]);

    $footerImage = HomeFooterImage::findOrFail($id);

    // If image is updated, save the new image
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('footer-images'), $imageName);
        $footerImage->image = $imageName;
    }

    // Update footer image data
    $footerImage->title = $request->title;
    $footerImage->link = $request->link;
    $footerImage->description = $request->description;
    $footerImage->language = $request->language;
    $footerImage->status = $request->status ?? 0;
    $footerImage->save();

    ManageAudit::create([
        'Module_Name' => 'Footer Image', // Static value
        'Time_Stamp' => time(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Update', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
    ]);

    return redirect()->route('admin.footer_images.index')->with('success', 'Footer image updated successfully.');
}


public function footer_image_destroy($id)
{
    // Find the footer image by ID or fail if not found
    $footerImage = HomeFooterImage::findOrFail($id);

    // Check if the status is 1 (Inactive), and prevent deletion
    if ($footerImage->status == 1) {
        return redirect()->route('admin.footer_images.index')
            ->with('error', 'Active footer images cannot be deleted.');
    }

    // Perform a soft delete by marking it with the current timestamp
    $footerImage->deleted_on = now();
    $footerImage->save();

    // Redirect back with a success message
    return redirect()->route('admin.footer_images.index')
        ->with('success', 'Footer image deleted successfully.');
}

public function footer_images_status_update(Request $request, $id)
{
    $slider = HomeFooterImage::findOrFail($id);
    $slider->status = !$slider->status; // Toggle status
    $slider->save();

    return response()->json(['success' => 'Status updated successfully.']);
}

  public function quick_link_list()
    {
        $quickLinks = QuickLink::where('is_deleted', 0)->get();
        return view('admin.home.quick_link_list', compact('quickLinks'));
    }

    // Show the form for creating a new quick link
    public function quick_link_create() 
    {
        return view('admin.home.quick_link_create');
    }

    // Store a newly created quick link
    public function quick_link_store(Request $request)
    {
        // print_r($_POST);die;
        $request->validate([
            'text' => 'required',
        ]);
      
        // Handle file upload if a file is uploaded
        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('quick-links-files'), $fileName);
        }
    
      
    QuickLink::create([
        'language' => $request->language,
        'text' => $request->text,
        'url' => $request->url ?? null,
        'url_type' => $request->url_type ?? null,
        'file' => $fileName ?? null,
        'status' => $request->status ?? 0,
        'is_deleted' => 0,
    ]);

    ManageAudit::create([
        'Module_Name' => 'Quick Link', // Static value
        'Time_Stamp' => time(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Insert', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
    ]);

        return redirect()->route('admin.quick_links.index')->with('success', 'Quick Link created successfully.');
    }

    // Show the form for editing an existing quick link
    public function quick_link_edit($id)
    {
        $quickLink = QuickLink::findOrFail($id);
        return view('admin.home.quick_link_edit', compact('quickLink'));
    }

    // Update an existing quick link
    public function quick_link_update(Request $request, $id)
    {
        // print_r($_POST);die;
        $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'nullable',
            'url_type' => 'nullable', // Adjust values as needed
            'status' => 'nullable|boolean',
            'file' => 'nullable', // Restrict file types and size
        ]);
    
        $quickLink = QuickLink::findOrFail($id);
    
        // Handle file upload if a file is uploaded
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($quickLink->file && file_exists(public_path('quick-links-files/' . $quickLink->file))) {
                unlink(public_path('quick-links-files/' . $quickLink->file));
            }
        
            // Save the new file
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('quick-links-files'), $fileName);
        
            // Assign the new file name to the model
            $quickLink->file = $fileName;
        }
    
        // Update quick link data
        $quickLink->text = $request->text;
        if($request->link_type  == 'file' ){
            $quickLink->url =  null;
        }else if($request->link_type == 'url'){
            $quickLink->file = null;
        }
       
    
        $quickLink->url_type = $request->url_type ?? null;
        $quickLink->status = $request->status ?? 0;
        $quickLink->language = $request->language;
        $quickLink->save();
    
        // Log the update action in ManageAudit
        ManageAudit::create([
            'Module_Name' => 'Quick Link', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
    
        // Redirect with success message
        return redirect()->route('admin.quick_links.index')->with('success', 'Quick Link updated successfully.');
    }
    

    // Soft delete a quick link
    public function quick_link_destroy($id)
    {
        $quickLink = QuickLink::findOrFail($id);
        $quickLink->is_deleted = 1;
        $quickLink->save();

        return redirect()->route('admin.quick_links.index')->with('success', 'Quick Link deleted successfully.');
    }
    function quick_link_status_update(Request $request, $id)
    {
        $slider = QuickLink::findOrFail($id);
        $slider->status = !$slider->status; // Toggle status
        $slider->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }
    function screen_reader(){
        $screenRender = DB::table('screenrender')->first();
        // print_r($screenRender);die;
        return view('admin.home.screenrender', compact('screenRender'));
    }
    function screen_reader_update(Request $request){
        DB::table('screenrender')->updateOrInsert(
            ['id' => 1], // Ensure the single row
            [
                'heading' => $request->input('heading'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]
        );
    
        return redirect()->back()->with('success', 'Screen render updated successfully!');
    }

    
}
