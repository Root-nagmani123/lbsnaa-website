<?php
// app/Http/Controllers/OrganizationSetupController.php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\OrganizationSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class OrganizationSetupController extends Controller
{
    public function index()
    {
        $organizations = DB::table('mirco_organization_setups as tp')
        ->leftJoin('research_centres as rc', 'tp.research_centre', '=', 'rc.id') // Adjust column names as needed
        ->select('tp.*', 'rc.research_centre_name as research_centre_name') // Include the name of the research centre
        ->get(); 

        return view('admin.micro.Organization_Setup.index', compact('organizations'));
    }


    public function create()
    {
        // Fetch only research centres with status == 1 (active)
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Add the condition for status
            ->pluck('research_centre_name', 'id'); // Fetch the name and id

        return view('admin.micro.Organization_Setup.create', compact('researchCentres'));
    }



    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'employee_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                // 'unique:mirco_organization_setups,email', // Uncomment if you want to enforce unique email validation
                'max:255',
            ],
            'program_description' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // 10MB max size
            'page_status' => 'required|integer|in:1,0',
        ];
        
        $messages = [
            'research_centre.required' => 'Please select a research centre.',
            'research_centre.string' => 'Research centre must be a valid string.',
            'research_centre.max' => 'Research centre cannot exceed 255 characters.',
        
            'language.required' => 'Please select a language.',
            'language.integer' => 'The language must be a valid number.',
            'language.in' => 'Invalid language selection.',
        
            'employee_name.required' => 'Please enter the employee name.',
            'employee_name.string' => 'Employee name must be a valid string.',
            'employee_name.max' => 'Employee name cannot exceed 255 characters.',
        
            'designation.required' => 'Please enter the designation.',
            'designation.string' => 'Designation must be a valid string.',
            'designation.max' => 'Designation cannot exceed 255 characters.',
        
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use. Please provide a different email.',
            'email.max' => 'The email address cannot exceed 255 characters.',
        
            'program_description.required' => 'Please provide a program description.',
            'program_description.string' => 'Program description must be a valid string.',
        
            'main_image.required' => 'Please upload an image.',
            'main_image.image' => 'The file must be an image.',
            'main_image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'main_image.max' => 'The image size must be less than 10MB.',
        
            'page_status.required' => 'Please select the page status.',
            'page_status.integer' => 'The page status must be a valid number.',
            'page_status.in' => 'Invalid status selection.',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();
    
        // Process the data
        $data = $request->all();
    
        // Handle file upload
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
    
            // Store the image path in $data
            $data['main_image'] = 'images/' . $imageName;
        }
    
        // Create the organization setup record
        OrganizationSetup::create($data);
    
        // Log audit details
        MicroManageAudit::create([
            'Module_Name' => 'Organization Setup', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
    
        // Redirect with success message
        return redirect()->route('non_org.index')->with('success', 'Organization setup created successfully.');
    }
    
    


    public function edit($id)
    {
        // Fetch the specific training program by ID
        $organizationSetup = OrganizationSetup::findOrFail($id); 

        // Fetch the research centers
        $researchCentres = DB::table('research_centres')
            ->select('id', 'research_centre_name')
            ->pluck('research_centre_name', 'id') // Retrieves an associative array of id => name
            ->toArray();
        // Pass the variables to the Blade file
        return view('admin.micro.Organization_Setup.edit', compact('organizationSetup', 'researchCentres'));
    }

    // public function update(Request $request, OrganizationSetup $organizationSetup)
    // {
    //     // Define validation rules
    //     $rules = [
    //         'research_centre' => 'required',
    //         'language' => 'required|integer|in:1,2',
    //         'employee_name' => 'required|string|max:255',
    //         'designation' => 'required|string|max:255',
    //         'email' => [
    //             'required',
    //             'email',
    //             // Rule::unique('mirco_organization_setups')->ignore($organizationSetup->id), // Ignore the current record
    //             'max:255',
    //         ],
    //         'program_description' => 'required|string|max:10000',
    //         'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional field with validation for image type and size
    //         'page_status' => 'required|integer|in:1,0',
    //     ];

    //     // Define custom error messages
    //     $messages = [
    //         'research_centre.required' => 'Please select a research centre.',
    //         'language.required' => 'Please select a language.',
    //         'language.in' => 'Invalid language selection.',
    //         'employee_name.required' => 'Please enter the employee name.',
    //         'employee_name.max' => 'The employee name cannot exceed 255 characters.',
    //         'designation.required' => 'Please enter the designation.',
    //         'designation.max' => 'The designation cannot exceed 255 characters.',
    //         'email.required' => 'Please enter an email address.',
    //         'email.email' => 'Please enter a valid email address.',
    //         'email.unique' => 'This email address is already in use. Please use a different email.',
    //         'email.max' => 'The email address cannot exceed 255 characters.',
    //         'program_description.required' => 'Please provide a program description.',
    //         'program_description.max' => 'The program description cannot exceed 500 characters.',
    //         'main_image.image' => 'The uploaded file must be an image.',
    //         'main_image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
    //         'main_image.max' => 'The image size cannot exceed 2MB.',
    //         'page_status.required' => 'Please select the page status.',
    //         'page_status.in' => 'Invalid status selection.',
    //     ];
        
    //     // Validate the request
    //     $request->validate($rules, $messages);
        
    //     // Extract validated data
    //     $data = $request->only([
    //         'research_centre',
    //         'language',
    //         'employee_name',
    //         'designation',
    //         'email',
    //         'program_description',
    //         'page_status',
    //     ]);
        
    //     // Handle file upload
    //     if ($request->hasFile('main_image')) {
    //         // Delete the old image if it exists
    //         if ($organizationSetup->main_image && file_exists(public_path($organizationSetup->main_image))) {
    //             unlink(public_path($organizationSetup->main_image));
    //         }

    //         $image = $request->file('main_image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $imageName);

    //         // Update image path in $data
    //         $data['main_image'] = 'images/' . $imageName;
    //     }
    //     // dd($data);
    //     // Update the record
    //     // $organizationSetup->update($data);

    //     $isUpdated = $organizationSetup->update($data);
    //     if ($isUpdated) {
    //         \Log::info('Update successful!', $data);
    //     } else {
    //         \Log::error('Update failed!', $data);
    //     }
        
    //     // Log audit details
    //     MicroManageAudit::create([
    //         'Module_Name' => 'Organization Setup',
    //         'Time_Stamp' => time(), // Use Carbon for better readability
    //         'Created_By' => null, // Replace with the authenticated user's ID if available
    //         'Updated_By' => null, // ID of the authenticated user performing the update
    //         'Action_Type' => 'Update',
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('non_org.index')->with('success', 'Organization setup updated successfully.');
    // }

    public function update(Request $request, $id)
    {
        // Validation and data preparation
        $rules = [
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'employee_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                // 'unique:mirco_organization_setups,email', // Uncomment if you want to enforce unique email validation
                'max:255',
            ],
            'program_description' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // 10MB max size
            'page_status' => 'required|integer|in:1,0',
        ];
        
        $messages = [
            'research_centre.required' => 'Please select a research centre.',
            'research_centre.string' => 'Research centre must be a valid string.',
            'research_centre.max' => 'Research centre cannot exceed 255 characters.',
        
            'language.required' => 'Please select a language.',
            'language.integer' => 'The language must be a valid number.',
            'language.in' => 'Invalid language selection.',
        
            'employee_name.required' => 'Please enter the employee name.',
            'employee_name.string' => 'Employee name must be a valid string.',
            'employee_name.max' => 'Employee name cannot exceed 255 characters.',
        
            'designation.required' => 'Please enter the designation.',
            'designation.string' => 'Designation must be a valid string.',
            'designation.max' => 'Designation cannot exceed 255 characters.',
        
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use. Please provide a different email.',
            'email.max' => 'The email address cannot exceed 255 characters.',
        
            'program_description.required' => 'Please provide a program description.',
            'program_description.string' => 'Program description must be a valid string.',
        
            'main_image.required' => 'Please upload an image.',
            'main_image.image' => 'The file must be an image.',
            'main_image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'main_image.max' => 'The image size must be less than 10MB.',
        
            'page_status.required' => 'Please select the page status.',
            'page_status.integer' => 'The page status must be a valid number.',
            'page_status.in' => 'Invalid status selection.',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();
    
        // Prepare the data for update
        $data = [
            'research_centre' => $request->input('research_centre'),
            'language' => $request->input('language'),
            'employee_name' => $request->input('employee_name'),
            'designation' => $request->input('designation'),
            'email' => $request->input('email'),
            'program_description' => $request->input('program_description'),
            'page_status' => $request->input('page_status'),
        ];
    
        // Handle file upload for main_image if a new one is uploaded
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['main_image'] = 'images/' . $imageName;
        }
    
        // Update the record using DB facade (direct SQL query without Eloquent)
        $updated = DB::table('mirco_organization_setups')
            ->where('id', $id)
            ->update($data);
    
        // Check if the update was successful
        if ($updated) {
            return redirect()->route('non_org.index')->with('success', 'Organization setup updated successfully.');
        } else {
            return redirect()->route('non_org.index')->with('error', 'No changes detected or update failed.');
        }
    }
    
    

    public function destroy($id)
    {
        DB::beginTransaction();
    // dd($id);
        try {
            $organizationSetup = OrganizationSetup::findOrFail($id);

            if ($organizationSetup->page_status == 1) {
                return redirect()->route('non_org.index')->with('error', 'Active organization setups cannot be deleted.');
            }

            \Log::info('Attempting to delete organization setup:', ['id' => $organizationSetup->id]);

            // Delete the organization setup
            if ($organizationSetup->delete()) {
                DB::commit();
                return redirect()->route('non_org.index')->with('success', 'Organization setup deleted successfully.');
            }

            DB::rollBack();
            return redirect()->route('non_org.index')->with('error', 'Failed to delete organization setup.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error during deletion:', ['error' => $e->getMessage()]);
            return redirect()->route('non_org.index')->with('error', 'An error occurred while trying to delete the organization setup.');
        }
    }

    



}