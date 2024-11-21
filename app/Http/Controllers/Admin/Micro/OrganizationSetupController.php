<?php
// app/Http/Controllers/OrganizationSetupController.php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\OrganizationSetup;
use Illuminate\Http\Request;


use App\Models\Admin\Micro\ManageAudit;
use Illuminate\Support\Facades\Auth;

class OrganizationSetupController extends Controller
{
    public function index()
    {
        $organizations = OrganizationSetup::all();
        return view('admin.micro.Organization_Setup.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.micro.Organization_Setup.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'research_centre' => 'required',
            'language' => 'required|integer|in:1,2',
            'employee_name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:mirco_organization_setups',
            'program_description' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Store the image path in $data
            $data['main_image'] = 'images/' . $imageName;
        }   

        OrganizationSetup::create($data);

        return redirect()->route('organization_setups.index')
                        ->with('success', 'Organization setup created successfully.');
    }


    public function edit(OrganizationSetup $organizationSetup)
    {
        return view('admin.micro.Organization_Setup.edit', compact('organizationSetup'));
    }

    public function update(Request $request, OrganizationSetup $organizationSetup)
    {
        $request->validate([
            'research_centre' => 'required',
            'language' => 'required|integer|in:1,2',
            'employee_name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:mirco_organization_setups,email,' . $organizationSetup->id,
            'program_description' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg', // optional if no image is uploaded
            'page_status' => 'required|integer|in:1,2,3',
        ]);
    
        $data = $request->all();
    
        // Handle file upload
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
    
            // Update image path in $data
            $data['main_image'] = 'images/' . $imageName;
        }
    
        $organizationSetup->update($data);
    
        return redirect()->route('organization_setups.index')
                         ->with('success', 'Organization setup updated successfully.');
    }
    

    public function destroy(OrganizationSetup $organizationSetup)
    {
        $organizationSetup->delete();

        return redirect()->route('organization_setups.index')
                         ->with('success', 'Organization setup deleted successfully.');
    }
}
