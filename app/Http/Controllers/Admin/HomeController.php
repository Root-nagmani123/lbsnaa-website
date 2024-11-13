<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Slider;
use App\Models\Admin\HomeFooterImage;
use App\Models\Admin\QuickLink;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // List all sliders
    public function slider_list()
    {
        $sliders = Slider::where('is_deleted', 0)->get();
        return view('admin.home.slider_list', compact('sliders'));
    }

    // Show the form for creating a new slider
    public function slider_create()
    {
        return view('admin.home.slider_create');
    }

    // Store a newly created slider in the database
    public function slider_store(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        //     'text' => 'required',
        //     'description' => 'required',
        // ]);

        // Save image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('slider-images'), $imageName);

        // Create slider
        Slider::create([
            'image' => $imageName,
            'text' => $request->text,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'is_deleted' => 0
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
        // $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif',
        //     'text' => 'required',
        //     'description' => 'required',
        // ]);

        $slider = Slider::findOrFail($id);

        // If image is updated, save the new image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('slider-images'), $imageName);
            $slider->image = $imageName;
        }

        // Update slider data
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

// Store a newly created footer image in the database
public function footer_image_store(Request $request)
{
    // $request->validate([
    //     'image' => 'required|image|mimes:jpeg,png,jpg,gif',
    // ]);

    // Save image
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('footer-images'), $imageName);

    // Create footer image
    HomeFooterImage::create([
        'language' => $request->language,
        'image' => $imageName,
        'status' => $request->status ?? 0,
        'deleted_on' => null,
    ]);

    ManageAudit::create([
        'Module_Name' => 'Footer Image', // Static value
        'Time_Stamp' => time(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Insert', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
    ]);

    return redirect()->route('admin.footer_images.index')->with('success', 'Footer image added successfully.');
}

// Show the form for editing an existing footer image
public function footer_image_edit($id)
{
    $footerImage = HomeFooterImage::findOrFail($id);
    return view('admin.home.footer_image_edit', compact('footerImage'));
}

// Update an existing footer image in the database
public function footer_image_update(Request $request, $id)
{
    // $request->validate([
    //     'image' => 'image|mimes:jpeg,png,jpg,gif',
    // ]);

    $footerImage = HomeFooterImage::findOrFail($id);

    // If image is updated, save the new image
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('footer-images'), $imageName);
        $footerImage->image = $imageName;
    }

    // Update footer image data
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

// Soft delete a footer image (setting deleted_on)
public function footer_image_destroy($id)
{
    $footerImage = HomeFooterImage::findOrFail($id);
    $footerImage->deleted_on = now();
    $footerImage->save();

    return redirect()->route('admin.footer_images.index')->with('success', 'Footer image deleted successfully.');
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
        'text' => $request->text,
        'url' => $request->url ?? null,
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
        $request->validate([
            'text' => 'required',
        ]);

        $quickLink = QuickLink::findOrFail($id);

        
        // Handle file upload if a file is uploaded
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('quick-links-files'), $fileName);
            $quickLink->file = $fileName;
        }
    
        // Update quick link data
        $quickLink->text = $request->text;
        $quickLink->url = $request->url ?? null;
        $quickLink->status = $request->status ?? 0;
        $quickLink->save();

        ManageAudit::create([
            'Module_Name' => 'Quick Link', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

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

    
}
