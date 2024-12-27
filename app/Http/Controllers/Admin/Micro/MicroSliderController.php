<?php
// app/Http/Controllers/MicroSliderController.php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;

class MicroSliderController extends Controller
{
    public function index()
    {
        // $sliders = MicroSlider::all(); // Fetch all sliders

        $sliders = DB::table('micro_sliders as tp')
        ->leftJoin('research_centres as rc', 'tp.research_centre', '=', 'rc.id') // Adjust column names as needed
        ->select('tp.*', 'rc.research_centre_name as research_centre_name') // Include the name of the research centre
        ->get();

        return view('admin.micro.slider.index', compact('sliders'));
    }

    // public function create()
    // {
    //     $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
    //     return view('admin.micro.slider.create',compact('researchCentres'));
    // }

    public function create()
    {
        // Fetch only active research centres (status == 1)
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Include only active research centres
            ->pluck('research_centre_name', 'id'); // Retrieves an associative array of id => name

        // Pass the active research centres to the view
        return view('admin.micro.slider.create', compact('researchCentres'));
    }



    public function store(Request $request)
    {
        // Define validation rules
        $validated = $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'slider_text' => 'required|string|max:255',
            'slider_description' => 'required|string',
            'research_centre' => 'required|string',
            'language' => 'required|integer|in:1,2',
            'status' => 'required|integer|in:1,0',
        ], [
            // Custom validation messages
            'slider_image.required' => 'Please upload a slider image.',
            'slider_image.image' => 'The file must be an image.',
            'slider_image.mimes' => 'Only jpeg, png, and jpg images are allowed.',
            'slider_image.max' => 'The image size must be less than 10MB.',
            
            'slider_text.required' => 'Please enter the slider text.',
            'slider_text.string' => 'The slider text must be a valid string.',
            'slider_text.max' => 'The slider text cannot exceed 255 characters.',
            
            'slider_description.required' => 'Please enter a slider description.',
            'slider_description.string' => 'The description must be a valid string.',
            
            'research_centre.required' => 'Please enter the research centre name.',
            'research_centre.string' => 'The research centre name must be a valid string.',
            
            'language.required' => 'Please select a language.',
            'language.integer' => 'The language must be a valid number.',
            'language.in' => 'The selected language is invalid.',
            
            'status.required' => 'Please select a status.',
            'status.integer' => 'The status must be a valid number.',
            'status.in' => 'The selected status is invalid.',
        ]);

        // Save the slider
        $slider = new MicroSlider();
        if ($request->hasFile('slider_image')) {
            $slider->slider_image = $request->file('slider_image')->store('sliders', 'public');
        }
        $slider->slider_text = $validated['slider_text'];
        $slider->slider_description = $validated['slider_description'];
        $slider->research_centre = $validated['research_centre'];
        $slider->language = $validated['language'];
        $slider->status = $validated['status'];
        $slider->save();

        // Log the action (audit trail)
        MicroManageAudit::create([
            'Module_Name' => 'Slider',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider created successfully!');
    }

    

    // public function edit($id)
    // {
    //     // Fetch the specific training program by ID
    //     $slider = MicroSlider::findOrFail($id); 
    //     // Fetch the research centers
    //     $researchCentres = DB::table('research_centres')
    //         ->select('id', 'research_centre_name')
    //         ->pluck('research_centre_name', 'id') // Retrieves an associative array of id => name
    //         ->toArray();
    //     // Pass the variables to the Blade file
    //     return view('admin.micro.slider.edit', compact('slider', 'researchCentres'));
    // }

    public function edit($id)
    {
        // Fetch the specific slider by ID
        $slider = MicroSlider::findOrFail($id);

        // Fetch only active research centers (status == 1)
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Include only active research centers
            ->pluck('research_centre_name', 'id') // Retrieves an associative array of id => name
            ->toArray();

        // Pass the variables to the Blade file
        return view('admin.micro.slider.edit', compact('slider', 'researchCentres'));
    }

    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'slider_text' => 'required|string|max:255',
            'slider_description' => 'required|string',
            'research_centre' => 'required|string',
            'language' => 'required|integer|in:1,2',
            'status' => 'required|integer|in:1,0',
        ]);
    
        $slider = MicroSlider::findOrFail($id);
        if ($request->hasFile('slider_image')) {
            $slider->slider_image = $request->file('slider_image')->store('sliders', 'public');
        }
        $slider->slider_text = $validated['slider_text'];
        $slider->slider_description = $validated['slider_description'];
        $slider->status = $validated['status'];
        $slider->save();
    
        MicroManageAudit::create([
            'Module_Name' => 'Slider',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully!');
    }

    public function destroy($id)
    {
        // Find the slider record by ID
        $slider = MicroSlider::findOrFail($id);

        // Check if the slider status is 1 (Active), and prevent deletion
        if ($slider->status == 1) {
            return redirect()->route('slider.index')->with('error', 'Active sliders cannot be deleted.');
        }

        // Delete the slider if status is not 1
        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully!');
    }

    
}
