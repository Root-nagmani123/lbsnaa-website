<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\FacultyMember;
use App\Models\Admin\StaffMember;
use App\Models\Admin\Staff; // Import the Staff model
use App\Models\Admin\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageOrganizationController extends Controller
{
    // List faculty members
    public function facultyIndex()
    {
        // $facultyMembers = FacultyMember::get();
        $facultyMembers = FacultyMember::orderBy('position', 'ASC')->get();
        return view('admin.faculty_members.index', compact('facultyMembers'));
    }

    public function facultyCreate()
    {
        $startYear = 2000;
        $currentYear = now()->year; // Get the current year
        $years = range($startYear, $currentYear); // Create an array of years
 
        // Fetch the codes from the manage_cadres table
        $cadres = DB::table('manage_cadres')->where('status',1)->pluck('code', 'id'); // Get id as key and code as value
        return view('admin.faculty_members.create', compact('cadres','years'));
    }

    // Store a new faculty member
    public function facultyStore(Request $request)
    {
        // // Validate input fields
        // $validated = $request->validate([
        //     'language' => 'required|in:1,2',
        //     'category' => 'required|in:0,1',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:faculty_members,email',
        //     'designation' => 'required|string|max:255',
        //     'page_status' => 'required|in:0,1',

        //     'phone_internal_office' => 'nullable|string',
        //     'phone_internal_residence' => 'nullable|string',
        //     'phone_pt_office' => 'nullable|string',
        //     'phone_pt_residence' => 'nullable|string',
        //     'mobile' => 'nullable|string',
            
        // ]);

        $rules = [
            'language' => 'required|in:1,2',
            'category' => 'required|in:0,1',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:staff_members,email',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^[\.\,\/\!\@\#\$\%\^\~]/', $value)) {
                        $fail("The {$attribute} must not start with special characters.");
                    }
                },
            ],
            'designation' => 'required|string|max:255',
            'page_status' => 'required|in:0,1',
            'phone_internal_office' => 'nullable|string',
            'phone_internal_residence' => 'nullable|string',
            'phone_pt_office' => 'nullable|string',
            'phone_pt_residence' => 'nullable|string',
            'std_code' => 'nullable|string',
            'country_code' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Store validation errors and old inputs in cache (for 1 minute)
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        
    
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('faculty_images/'), $imageName);
            $imagePath = 'faculty_images/' . $imageName;
        }
        // Insert data into the database using Query Builder
        DB::table('faculty_members')->insert([
            'language' => $request->language,
            'category' => $request->category,
            'name' => $request->name,
            'name_in_hindi' => $request->name_in_hindi,
            'email' => $request->email,
            'image' => $imagePath,
            'description' => $request->description,
            'description_in_hindi' => $request->description_in_hindi,
            'designation' => $request->designation,
            'designation_in_hindi' => $request->designation_in_hindi,
            'cadre' => $request->cadre,
            'batch' => $request->batch,
            'service' => $request->service,
            'country_code' => $request->country_code,
            'std_code' => $request->std_code,
            'phone_internal_office' => $request->phone_internal_office,
            'phone_internal_residence' => $request->phone_internal_residence,
            'phone_pt_office' => $request->phone_pt_office,
            'phone_pt_residence' => $request->phone_pt_residence,
            'mobile' => $request->mobile,
            'abbreviation' => $request->abbreviation,
            'rank' => $request->rank,
            'present_at_station' => $request->present_at_station,
            'page_status' => $request->page_status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Redirect with success message
        Cache::put('success_message', 'Faculty Member added successfully!', 1);
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member added successfully.');
    }
    



    // Show form to edit faculty member
    public function facultyEdit($id)
    {
        $startYear = 2000;
        $currentYear = now()->year; // Get the current year
        $years = range($startYear, $currentYear); // Create an array of years

        // Find the faculty member by ID
        $faculty = FacultyMember::findOrFail($id);
        $cadres = DB::table('manage_cadres')->get();
        // Return the edit view with the faculty data
        return view('admin.faculty_members.edit', compact('faculty','cadres','years'));
    }

    // Update faculty member
    public function facultyUpdate(Request $request, $id)
    {
        $facultyMember = FacultyMember::findOrFail($id);

        $rules = [
            'category' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:faculty_members,email,' . $facultyMember->id,
            'designation' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_internal_office' => 'nullable|digits:10',
            'phone_internal_residence' => 'nullable|digits:10',
            'phone_pt_office' => 'nullable|digits:10',
            'phone_pt_residence' => 'nullable|digits:10',
            'mobile' => 'nullable|digits:10',
            'std_code' => 'nullable|string',
            'country_code' => 'nullable|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Store validation errors and old inputs in cache (for 1 minute)
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (isset($facultyMember->image) && file_exists(public_path($facultyMember->image))) {
                try {
                    // Attempt to delete the old image
                    unlink(public_path($facultyMember->image));
                } catch (\Exception $e) {
                    // Log the error if unlink fails
                    \Log::error('Error deleting image: ' . $e->getMessage());
                }
            }
        
            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('faculty-images'), $imageName);
        
            $data['image'] = 'faculty-images/' . $imageName;
        }
        $facultyMember->update($data);

        ManageAudit::create([
            'Module_Name' => 'Organization Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Faculty member updated successfully.', 1);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member updated successfully.');
    }

    // Delete faculty member
    public function facultyDestroy($id)
    {
        // Find the faculty member by ID
        $facultyMember = FacultyMember::findOrFail($id);
        // Check if the faculty member is already inactive (status = 1 or 0), and prevent deletion if necessary
        if ($facultyMember->page_status == 1) {
        Cache::put('error_message', 'Active faculty members cannot be deleted', 1);
            
            return redirect()->route('admin.faculty.index')->with('error', 'Active faculty members cannot be deleted.');
        }
        // Permanently delete the faculty member from the database
        $facultyMember->delete();
        // Redirect back with a success message
        Cache::put('success_message', 'Faculty deleted successfully', 1);

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member deleted successfully.');
    }



    public function staffIndex()
    {
        // $staffMembers = StaffMember::all();
        $staffMembers = StaffMember::orderBy('position', 'ASC')->get();
        return view('admin.staff_members.index', compact('staffMembers'));
    }

    // Staff Create
    public function staffCreate()
    {
        return view('admin.staff_members.create');
    }


    // Staff Store
    public function staffStore(Request $request)
    {
        // Validate input fields
        $rules = [
            'language' => 'required|string|in:1,2',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:staff_members,email',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^[\.\,\/\!\@\#\$\%\^\~]/', $value)) {
                        $fail("The {$attribute} must not start with special characters.");
                    }
                },
            ],
            'designation' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:staff_members,mobile',
            'phone_pt_office' => 'nullable|string',
            'std_code' => 'nullable|string',
            'country_code' => 'nullable|string',
            'page_status' => 'required|in:1,0',
            'present_at_station' => 'required|in:1,0',
            'acm_member' => 'required|in:1,0',
            'co_opted_member' => 'required|in:1,0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    
        // Custom Error Messages
        $messages = [
            'email.required' => 'The email field is mandatory.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use. Please use another one.',
            'mobile.required' => 'The mobile number is mandatory.',
            'mobile.unique' => 'This mobile number is already registered.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Only JPG, PNG, and JPEG formats are allowed.',
            'image.max' => 'The image size should not exceed 2MB.',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }

    

        // Handling image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('staff_images'), $imageName);
            $validated['image'] = 'staff_images/' . $imageName;
        }

        // Save the validated data into the database
        $staff = StaffMember::create($validated);

        // Audit log creation
        ManageAudit::create([
            'Module_Name' => 'Staff Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
        Cache::put('success_message', 'Staff member created successfully!', 1);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member created successfully!');
    }


    // Staff Edit
    public function staffEdit($id)
    {
        $staff = StaffMember::findOrFail($id);
        return view('admin.staff_members.edit', compact('staff'));
    }

    // Staff Update
    public function staffUpdate(Request $request, $id)
    {
        $staff = StaffMember::findOrFail($id);

        // Validate input fields
        $validator = Validator::make($request->all(), [
            'language' => 'required|string|in:1,2',
            'name' => 'required|string|max:255',
            
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('staff_members', 'email')->ignore($id),
            ],
            
            'designation' => 'required|string|max:255',
            
            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('staff_members', 'mobile')->ignore($id),
            ],
            
            // Optional fields
            'phone_pt_office' => 'nullable|string',
            'std_code' => 'nullable|string',
            'country_code' => 'nullable|string',

            'page_status' => 'required|in:1,0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already in use.',

            'mobile.required' => 'Mobile number is required.',
            'mobile.unique' => 'This mobile number is already registered.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',

            'page_status.required' => 'Page status is required.',
            'image.mimes' => 'Only JPG, PNG, and JPEG formats are allowed.',
            'image.max' => 'Image size must not exceed 2MB.',
        ]);

        if ($validator->fails()) {
            // Store validation errors and old inputs in cache (for 1 minute)
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }


        $staffData = $request->all();

        // Handling image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($staff->image && file_exists(public_path($staff->image))) {
                unlink(public_path($staff->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('staff_images'), $imageName);
            $staffData['image'] = 'staff_images/' . $imageName;
        }

        $staff->update($staffData);

        ManageAudit::create([
            'Module_Name' => 'Staff Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Staff member updated successfully', 1);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully!');
    }

    public function staffDestroy($id)
    {
        // Fetch the staff member by ID
        $staff = DB::table('staff_members')->where('id', $id)->first();
    
        // Check if the staff member exists
        if (!$staff) {
        Cache::put('error_message', 'Staff member not found.', 1);

            return redirect()->route('admin.staff.index')->with('error', 'Staff member not found.');
        }
    
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($staff->page_status == 1) {
        Cache::put('error_message', 'Active staff members cannot be deleted', 1);

            return redirect()->route('admin.staff.index')->with('error', 'Active staff members cannot be deleted.');
        }
    
        // Delete staff image if it exists
        if ($staff->image && file_exists(public_path($staff->image))) {
            unlink(public_path($staff->image));
        }
    
        // Delete the staff record from the database
        DB::table('staff_members')->where('id', $id)->delete();
        Cache::put('success_message', 'Staff member deleted successfully!', 1);
    
        return redirect()->route('admin.staff.index')->with('success', 'Staff member deleted successfully!');
    }
    
    public function sectionIndex()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }
 
    // Section create method to show the create form
    public function sectionCreate()
    {
      
        return view('admin.sections.create');
    }

    // Section store method to handle form submission for creating new section
    public function sectionStore(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'language' => 'required|in:1,2', // Adjust the 'in' values to your available language options
            'title' => 'required|string|max:255', // Title is required, must be a string, and max length is 255
            'status' => 'required|in:1,0', // Status must be one of these options
        ], [
            'language.required' => 'Please select a language.', // Custom message for language
            'language.in' => 'Invalid language selected.', // Invalid language option message
            'title.required' => 'Please enter a title.', // Custom message for title
            'title.max' => 'Title must not exceed 255 characters.', // Custom message for max length
            'status.required' => 'Please select a status.', // Custom message for status
            'status.in' => 'Invalid status selected.', // Invalid status option message
        ]);
        
        // Agar validation fail hota hai
        if ($validator->fails()) {
            Cache::put('validation_errors', $validator->errors()->toArray(), 1); // Cache me pehla error store karna
            return redirect(session('url.previousdata', url('/')));
        }
        
        $sectionData = $request->all(); // No validation

        Section::create($sectionData);
        Cache::put('success_message', 'Section added successfully', 1);

        return redirect()->route('sections.index')->with('success', 'Section added successfully');
    }

    // Section edit method to show the edit form for a specific section
    public function sectionEdit($id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit', compact('section'));
    }

    // Section update method to handle form submission for updating section details
    public function sectionUpdate(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        $sectionData = $request->all(); // No validation

        $section->update($sectionData);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully');
    }

    // Section destroy method to delete a section
    public function sectionDestroy($id)
    {
        $section = Section::findOrFail($id);
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($section->status == 1) {
        Cache::put('error_message', 'Active section cannot be deleted.', 1);
            
            return redirect()->route('sections.index')->with('error', 'Active section cannot be deleted.');
        }

        $section->delete();
        Cache::put('success_message', 'Section deleted successfully.', 1);

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }

    public function indexSectionCategory(Request $request)
    {
        // Get the catid from the query string
        $id = $request->catid;

        // Fetch sections using the query builder
        // $sections = DB::table('section_category')
        //     ->select('name', 'description', 'officer_Incharge', 'status', 'id')
        //     ->where('section_id', $id)
        //     ->get();
        $sections = DB::table('section_category')
        ->select(
            'section_category.name',
            'section_category.description',
            'section_category.status',
            'section_category.id',
            'officer_data.name as officer_Incharge'
        )
        ->leftJoin(
            DB::raw('(
                SELECT id, name, email COLLATE utf8mb4_general_ci as email, "Staff" as type FROM staff_members
                UNION
                SELECT id, name, email COLLATE utf8mb4_general_ci as email, "Faculty" as type FROM faculty_members
            ) as officer_data'),
            'section_category.officer_Incharge',
            '=',
            DB::raw('officer_data.email COLLATE utf8mb4_general_ci')
        )
        ->where('section_category.section_id', $id)
        ->get();
// print_r($sections);die;

        // Return the view with the sections and id
        return view('admin.sections.section_category.index', compact('sections', 'id'));
    }



    public function createSectionCategory(REQUEST $request)
    {
        // Fetch sections using query builder
        $id = $request->catid;
        // $staff = DB::table('staff_members')->where('page_status', 1)->get()->map(function ($item) {
        //     $item->type = 'Staff'; // Add a type property
        //     return $item;
        // });
        $faculty = DB::table('faculty_members')->where('page_status', 1)->get()->map(function ($item) {
            $item->type = 'Faculty'; // Add a type property
            return $item;
        });
        
        $officers =$faculty;
        return view('admin.sections.section_category.create', compact('id','officers'));
    }
    
    public function storeSectionCategory(Request $request)
    {
        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'officer_Incharge' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.email' => 'Enter a valid email address.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Invalid status value.',
        ]);
    
        // Agar validation fail hota hai
        if ($validator->fails()) {
            Cache::put('validation_errors', $validator->errors()->toArray(), 1); // Pehla error message cache me store karega
            return redirect(session('url.previousdata', url('/')))
                ->withErrors($validator)
                ->withInput(); // Pichle inputs ko preserve karega
        }
    
        // Insert data using query builder
        DB::table('section_category')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'officer_Incharge' => $request->officer_Incharge,
            'alternative_Incharge_1st' => $request->alternative_incharge_1st,
            'alternative_Incharge_2st' => $request->alternative_incharge_2st,
            'alternative_Incharge_3st' => $request->alternative_incharge_3st,
            'alternative_Incharge_4st' => $request->alternative_incharge_4st,
            'alternative_Incharge_5st' => $request->alternative_incharge_5st,
            'section_head' => $request->section_head,
            'phone_internal_office' => $request->phone_internal_office,
            'phone_internal_residence' => $request->phone_internal_residence,
            'phone_p_t_office' => $request->phone_p_t_office,
            'phone_p_t_residence' => $request->phone_p_t_residence,
            'fax' => $request->fax,
            'email' => $request->email,
            'status' => $request->status,
            'section_id' => $request->section_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Audit Log Insert
        ManageAudit::create([
            'Module_Name' => 'Section Category',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
    
        // Success Message Cache
        Cache::put('success_message', 'Section Category created successfully!', 1);
    
        // Redirect Using Session-Stored Previous URL
        return redirect()->route('admin.section_category.index', ['catid' => $request->section_id]);
    }
    
    public function editSectionCategory($id)
    {
        // Fetch section category and sections using query builder
        $sectionCategory = DB::table('section_category')->where('id', $id)->first();
        // dd($sectionCategory->section_id);
        // $staff = DB::table('staff_members')->where('page_status', 1)->get()->map(function ($item) {
        //     $item->type = 'Staff'; // Add a type property
        //     return $item;
        // });
        $faculty = DB::table('faculty_members')->where('page_status', 1)->get()->map(function ($item) {
            $item->type = 'Faculty'; // Add a type property
            return $item;
        });
        
        $officers = $faculty;
        return view('admin.sections.section_category.edit', compact('sectionCategory','officers'));
    }
    public function updateSectionCategory(Request $request, $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'officer_Incharge' => 'nullable|string',
            'email' => 'nullable|email',
            'status' => 'required|boolean',
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.email' => 'Enter a valid email address.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Invalid status value.',
        ]);
    
        // Agar validation fail hota hai
        if ($validator->fails()) {
            Cache::put('validation_errors', $validator->errors()->toArray(), 1); // Pehla error cache me store karega
            return redirect(session('url.previousdata', url('/')))
                ->withErrors($validator)
                ->withInput(); // Inputs preserve rahenge
        }
    
        // Check if record exists
        $section = DB::table('section_category')->where('id', $id)->first();
        if (!$section) {
            Cache::put('error_message', 'Section Category not found!', 1);
            return redirect(session('url.previousdata', url('/')))->withErrors(['error' => 'Section Category not found!']);
        }
    
        // Update the record
        DB::table('section_category')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'officer_Incharge' => $request->officer_Incharge,
            'alternative_Incharge_1st' => $request->alternative_Incharge_1st,
            'alternative_Incharge_2st' => $request->alternative_Incharge_2st,
            'alternative_Incharge_3st' => $request->alternative_Incharge_3st,
            'alternative_Incharge_4st' => $request->alternative_Incharge_4st,
            'alternative_Incharge_5st' => $request->alternative_Incharge_5st,
            'section_head' => $request->section_head,
            'phone_internal_office' => $request->phone_internal_office,
            'phone_internal_residence' => $request->phone_internal_residence,
            'phone_p_t_office' => $request->phone_p_t_office,
            'phone_p_t_residence' => $request->phone_p_t_residence,
            'fax' => $request->fax,
            'email' => $request->email,
            'status' => $request->status,
            'updated_at' => now(),
        ]);
    
        // Success message cache me store karega
        Cache::put('success_message', 'Section Category updated successfully!', 1);
    
        // Redirect with success message
        return redirect()->route('admin.section_category.index', ['catid' => $request->section_id]);
    }
    
    public function updateSectionCategory_bkp(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'officer_Incharge' => 'nullable|string',
            'email' => 'nullable|email',
            'status' => 'required|boolean',
        ]);

        // Update data using query builder
        DB::table('section_category')->where('id', $id)->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'officer_Incharge' => $validatedData['officer_Incharge'],
            'alternative_Incharge_1st' => $request->alternative_Incharge_1st,
            'alternative_Incharge_2st' => $request->alternative_Incharge_2st,
            'alternative_Incharge_3st' => $request->alternative_Incharge_3st,
            'alternative_Incharge_4st' => $request->alternative_Incharge_4st,
            'alternative_Incharge_5st' => $request->alternative_Incharge_5st,
            'section_head' => $request->section_head,
            'phone_internal_office' => $request->phone_internal_office,
            'phone_internal_residence' => $request->phone_internal_residence,
            'phone_p_t_office' => $request->phone_p_t_office,
            'phone_p_t_residence' => $request->phone_p_t_residence,
            'fax' => $request->fax,
            'email' => $validatedData['email'],
            'status' => $validatedData['status'],
            'updated_at' => now(), 
        ]);
        return redirect()->route('admin.section_category.index', ['catid' => $request->section_id])->with('success', 'Section Category updated successfully');
    }
    public function destroySectionCategory($id)
    {
        // Delete using query builder
        $sectionCategory = DB::table('section_category')->select('section_id')->where('id', $id)->first();        
        DB::table('section_category')->where('id', $id)->delete();
        Cache::put('success_message', 'Section Category deleted successfully!', 1);

        return redirect()->route('admin.section_category.index', ['catid' => $sectionCategory->section_id])->with('success', 'Section Category deleted successfully');
    }
    public function update_facultyOrder(Request $request)
    {
        $order = $request->order;
    
        foreach ($order as $index => $id) {
            DB::table('faculty_members')
                ->where('id', $id)
                ->update(['position' => $index + 1]);
        }
    
        return response()->json(['success' => true]);
    }
    public function updateStaffOrder(Request $request)
{
    $order = $request->order;

    foreach ($order as $index => $id) {
        DB::table('staff_members')
            ->where('id', $id)
            ->update(['position' => $index + 1]);
    }

    return response()->json(['success' => true]);
}



    
}
