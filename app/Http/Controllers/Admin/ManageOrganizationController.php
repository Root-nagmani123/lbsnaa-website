<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\FacultyMember;
use App\Models\Admin\StaffMember;
use App\Models\Admin\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageOrganizationController extends Controller
{
    // List faculty members
    public function facultyIndex()
    {
        $facultyMembers = FacultyMember::get();
        return view('admin.faculty_members.index', compact('facultyMembers'));
    }

    // Show form to create faculty member
    public function facultyCreate()
    {
        return view('admin.faculty_members.create');
    }

    // Store a new faculty member
    public function facultyStore(Request $request)
    {
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('faculty_images/'), $imageName);
            $imagePath = 'faculty_images/' . $imageName;
        } else {
            $imagePath = null; // Handle if no image is uploaded
        }

        // Insert the data into the database
        $facultyMember = new FacultyMember();
        $facultyMember->language = $request->input('txtlanguage');
        $facultyMember->category = $request->input('category');
        $facultyMember->name = $request->input('name');
        $facultyMember->name_in_hindi = $request->input('name_in_hindi');
        $facultyMember->email = $request->input('email');
        $facultyMember->image = $imagePath; // Save the image path
        $facultyMember->description = $request->input('description');
        $facultyMember->description_in_hindi = $request->input('description_in_hindi');
        $facultyMember->designation = $request->input('designation');
        $facultyMember->designation_in_hindi = $request->input('designation_in_hindi');
        $facultyMember->cadre = $request->input('cadre');
        $facultyMember->batch = $request->input('batch');
        $facultyMember->service = $request->input('service');
        $facultyMember->country_code = $request->input('country_code');
        $facultyMember->std_code = $request->input('std_code');
        $facultyMember->phone_internal_office = $request->input('phone_internal_office');
        $facultyMember->phone_internal_residence = $request->input('phone_internal_residence');
        $facultyMember->phone_pt_office = $request->input('phone_pt_office');
        $facultyMember->phone_pt_residence = $request->input('phone_pt_residence');
        $facultyMember->mobile = $request->input('mobile');
        $facultyMember->abbreviation = $request->input('abbreviation');
        $facultyMember->rank = $request->input('rank');
        $facultyMember->present_at_station = $request->input('present_at_station');
        $facultyMember->acm_member = $request->input('acm_member');
        $facultyMember->acm_status_in_committee = $request->input('acm_status_in_committee');
        $facultyMember->co_opted_member = $request->input('co_opted_member');
        $facultyMember->page_status = $request->input('page_status');
// print_r($facultyMember);die;
        // Save the faculty member
        $facultyMember->save();

        ManageAudit::create([
            'Module_Name' => 'Organization Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member added successfully.');
    }

    // Show form to edit faculty member
    public function facultyEdit($id)
    {
        // Find the faculty member by ID
        $faculty = FacultyMember::findOrFail($id);
        
        // Return the edit view with the faculty data
        return view('admin.faculty_members.edit', compact('faculty'));
    }

    // Update faculty member
    public function facultyUpdate(Request $request, $id)
    {
        $facultyMember = FacultyMember::findOrFail($id);

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:faculty_members,email,' . $facultyMember->id,
            'designation' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (file_exists(public_path($facultyMember->image))) {
                unlink(public_path($facultyMember->image));
            }

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

        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member updated successfully.');
    }

    // Delete faculty member
    public function facultyDestroy($id)
    {
        $facultyMember = FacultyMember::findOrFail($id);
        $facultyMember->update(['page_status' => 0]);
        return redirect()->route('admin.faculty.index')->with('success', 'Faculty member deleted successfully.');
    }

    public function staffIndex()
    {
        $staffMembers = StaffMember::all();
        return view('admin.staff_members.index', compact('staffMembers'));
    }

    // Staff Create
    public function staffCreate()
    {
        return view('admin.staff_members.create');
    }

    // // Staff Store
    // public function staffStore(Request $request)
    // {
       

    //     $staffData = $request->all();

    //     // Handling image upload
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('staff_images'), $imageName);
    //         $staffData['image'] = 'staff_images/' . $imageName;
    //     }
    
    //     $Staff = StaffMember::create($staffData);

    //     ManageAudit::create([
    //         'Module_Name' => 'Staff Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('admin.staff.index')->with('success', 'Staff member created successfully!');
    // }

    // Staff Store
    public function staffStore(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'language' => 'required|string|in:1,2', // Replace with your dropdown options
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff_members,email', // Ensure unique email
            'designation' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:staff_members,mobile', // Ensure valid 10-digit mobile number

            // Optional fields with uniqueness and format validation
            'phone_internal_office' => 'nullable|digits:10|unique:staff_members,phone_internal_office',
            'phone_pt_office' => 'nullable|digits:10|unique:staff_members,phone_pt_office',
            'phone_pt_residence' => 'nullable|digits:10|unique:staff_members,phone_pt_residence',
            'phone_internal_residence' => 'nullable|digits:10|unique:staff_members,phone_internal_residence',
        

            'page_status' => 'required|in:1,0', // Replace with your dropdown options
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image upload with size and format constraints
        ]);

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
       $validated = $request->validate([
            'language' => 'required|string|in:1,2', // Replace with your dropdown options
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff_members,email', // Ensure unique email
            'designation' => 'required|string|max:255',
            // 'mobile' => 'required|digits:10|unique:staff_members,mobile', // Ensure valid 10-digit mobile number

            // Optional fields with uniqueness and format validation
            // 'phone_internal_office' => 'nullable|digits:10|unique:staff_members,phone_internal_office',
            // 'phone_pt_office' => 'nullable|digits:10|unique:staff_members,phone_pt_office',
            // 'phone_pt_residence' => 'nullable|digits:10|unique:staff_members,phone_pt_residence',
            // 'phone_internal_residence' => 'nullable|digits:10|unique:staff_members,phone_internal_residence',
        
            'page_status' => 'required|in:1,0', // Replace with your dropdown options
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Optional image upload with size and format constraints
        ]);

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
    
        $Staff = $staff->update($staffData);

        ManageAudit::create([
            'Module_Name' => 'Staff Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully!');
    }

    // Staff Destroy
    public function staffDestroy($id)
    {
        $staff = Staff::findOrFail($id);

        // Delete staff image if it exists
        if ($staff->image && file_exists(public_path($staff->image))) {
            unlink(public_path($staff->image));
        }
    
        // Delete staff record from the database
        $staff->delete();
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
        $request->validate(
            [
                'language' => 'required|in:1,2', // Adjust the 'in' values to your available language options
                'title' => 'required|string|max:255', // Title is required, must be a string, and max length is 255
                'status' => 'required|in:1,0', // Status must be one of these options
            ],
            [
                'language.required' => 'Please select a language.', // Custom message for language
                'language.in' => 'Invalid language selected.', // Invalid language option message
                'title.required' => 'Please enter a title.', // Custom message for title
                'title.max' => 'Title must not exceed 255 characters.', // Custom message for max length
                'status.required' => 'Please select a status.', // Custom message for status
                'status.in' => 'Invalid status selected.', // Invalid status option message
            ]
        );
        
        $sectionData = $request->all(); // No validation

        Section::create($sectionData);

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
            return redirect()->route('sections.index')->with('error', 'Inactive section cannot be deleted.');
        }

        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully');
    }
    public function indexSectionCategory(REQUEST $request)
    {
        // dd('hi');
        // Fetch sections using query builder
        $id = $request->catid;
        // $sections = DB::table('sections')->select('name','description','status','id')->from('sections')->get();
        $sections = DB::table('section_category')->select('name','description','officer_Incharge','status','id')->where('section_id',$id)->get();


        // $sections =  DB::table('section_category')->select('name','description','officer_Incharge','status','id')->from('section_category')->get();
        // print_r($data);die;
        return view('admin.sections.section_category.index', compact('sections','id'));
    }
    public function createSectionCategory(REQUEST $request)
    {
        // Fetch sections using query builder
        $id = $request->catid;
        return view('admin.sections.section_category.create', compact('id'));
    }
    
    public function storeSectionCategory(Request $request)
    {
        // print_r($_POST)
      
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'officer_Incharge' => 'nullable|string',
            'email' => 'nullable|email',
            'status' => 'required|boolean',
        ]);
    
        // Insert data using query builder
        DB::table('section_category')->insert([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'officer_Incharge' => $validatedData['officer_Incharge'],
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
            'email' => $validatedData['email'],
            'status' => $validatedData['status'],
            'section_id' => $request->section_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        ManageAudit::create([
            'Module_Name' => 'Section Category', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.section_category.index', ['catid' => $request->section_id])->with('success', 'Section Category created successfully');
}
    public function editSectionCategory($id)
{
    // Fetch section category and sections using query builder
    $sectionCategory = DB::table('section_category')->where('id', $id)->first();
   
    
    return view('admin.sections.section_category.edit', compact('sectionCategory'));
}

public function updateSectionCategory(Request $request, $id)
{
    // print_r($_POST);die;
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

    return redirect()->route('admin.section_category.index',$sectionCategory->section_id)->with('success', 'Section Category deleted successfully');
}

    
}
