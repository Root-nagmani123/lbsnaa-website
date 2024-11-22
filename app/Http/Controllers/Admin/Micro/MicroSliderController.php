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

    public function create()
    {
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        return view('admin.micro.slider.create',compact('researchCentres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'slider_text' => 'required|string|max:255',
            'slider_description' => 'required|string',
            'research_centre' => 'required|string',
            'language' => 'required|integer|in:1,2',
            'status' => 'required|integer|in:1,2,3',
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
    

    public function edit($id)
    {
        // Fetch the specific training program by ID
        $slider = MicroSlider::findOrFail($id); 
        // Fetch the research centers
        $researchCentres = DB::table('research_centres')
            ->select('id', 'research_centre_name')
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
            'status' => 'required|integer|in:1,2,3',
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
        $slider = MicroSlider::findOrFail($id);
        $slider->delete();
    
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully!');
    }
    
}
