<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class TrainingManagementController extends Controller
{

    // Display form

    public function categoryIndex()
    {

        $category = DB::table('manage_category')->get();
        return view('admin.manage_category.index', compact('category'));
    }

    // Category create method to show the create form
    public function categoryCreate()
    {
        return view('admin.manage_category.create');
    }


    // Category store method to handle form submission for creating new section
    public function categoryStore(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'txtlanguage' => 'required|string|max:255', // Ensure language is selected
            'section_title' => 'required|string|max:255', // Section title is required
            'category_description' => 'required|max:255', // Description can be null
            'status' => 'required|in:0,1', // Status must be either 0 or 1
        ], [
            'txtlanguage.required' => 'Please select a language.', // Custom error message
            'section_title.required' => 'The section title is required.', // Custom error message
            'category_description.required' => 'The Category Description is required.', // Custom error message
            'status.required' => 'Please select a valid status.', // Custom error message
        ]);

        // Insert the category into the database
        $category = DB::table('manage_category')->insert([
            'language' => $validatedData['txtlanguage'],
            'section_title' => $validatedData['section_title'],
            'category_description' => $validatedData['category_description'],
            'status' => $validatedData['status'],
        ]);

        // Log the action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Category Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('category.index')->with('success', 'Category added successfully.');
    }


    // Category edit method to show the edit form for a specific section
    public function categoryEdit($id)
    {

        $category = DB::table('manage_category')->where('id', $id)->first();
        return view('admin.manage_category.edit', compact('category'));
    }

    // Category update method to handle form submission for updating section details
    public function categoryUpdate(Request $request, $id)
    {
        $category = DB::table('manage_category')->where('id', $id)->update([
            'language' => $request->txtlanguage,
            'section_title' => $request->section_title,
            'category_description' => $request->category_description,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'Category Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('category.index')->with('success', 'category updated successfully');
    }


    // Category destroy method to delete a section
    public function categoryDestroy($id)
    {
        // Fetch the category from the database
        $category = DB::table('manage_category')->where('id', $id)->first();

        // Check if the category exists
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($category->status == 1) {
            return redirect()->route('category.index')->with('error', 'Active categories cannot be deleted.');
        }
        // Delete the category
        DB::table('manage_category')->where('id', $id)->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }



    public function countryIndex()
    {

        $country = DB::table('manage_country')->get();
        return view('admin.manage_country.index', compact('country'));
    }

    // country create method to show the create form
    public function countryCreate()
    {
        return view('admin.manage_country.create');
    }

    public function countryStore(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'country_name' => 'required|string|max:255|unique:manage_country,country_name', // Ensure unique and valid country name
            'country_name_hindi' => 'required|string|max:255', // Optional and valid Hindi country name
            'status' => 'required|in:0,1', // Status must be either 0 or 1
        ], [
            'country_name.required' => 'The country name is required.',
            'country_name.unique' => 'This country name already exists.',
            'country_name_hindi' => 'The hindi country name is required.',
            'status.required' => 'Please select a valid status.',
        ]);

        // Insert the country into the database
        DB::table('manage_country')->insert([
            'country_name' => $validatedData['country_name'],
            'country_name_hindi' => $validatedData['country_name_hindi'],
            'status' => $validatedData['status'],
        ]);

        // Log the action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Country Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('country.index')->with('success', 'Country added successfully.');
    }


    // country edit method to show the edit form for a specific section
    public function countryEdit($id)
    {

        $country = DB::table('manage_country')->where('id', $id)->first();
        return view('admin.manage_country.edit', compact('country'));
    }

    public function countryUpdate(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'country_name' => "required|string|max:255|unique:manage_country,country_name,$id", // Ensure unique name except for the current record
            'country_name_hindi' => 'required|string|max:255', // Optional and valid Hindi country name
            'status' => 'required|in:0,1', // Status must be either 0 or 1
        ], [
            'country_name.required' => 'The country name is required.',
            'country_name.unique' => 'This country name already exists.',
            'country_name_hindi' => 'The hindi country name is required.',
            'status.required' => 'Please select a valid status.',
        ]);

        // Update the country in the database
        DB::table('manage_country')->where('id', $id)->update([
            'country_name' => $validatedData['country_name'],
            'country_name_hindi' => $validatedData['country_name_hindi'],
            'status' => $validatedData['status'],
        ]);

        // Log the update action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Country Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // ID of the authenticated user
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('country.index')->with('success', 'Country updated successfully.');
    }

    public function countryDestroy($id)
    {
        // Retrieve the country by ID
        $country = DB::table('manage_country')->where('id', $id)->first();

        // Check if the country exists and the status is 1 (Inactive)
        if ($country && $country->status == 1) {
            return redirect()->route('country.index')->with('error', 'Active countries cannot be deleted.');
        }

        // Proceed to delete the country if not inactive
        DB::table('manage_country')->where('id', $id)->delete();

        return redirect()->route('country.index')->with('success', 'Country deleted successfully.');
    }



    public function stateIndex()
    {

        $states = DB::table('manage_state')->get();
        return view('admin.manage_state.index', compact('states'));
    }

    // state create method to show the create form
    public function stateCreate()
    {
        return view('admin.manage_state.create');
    }

    public function stateStore(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'state_name' => 'required|string|max:255',
            'state_name_hindi' => 'required|string|max:255', // Optional and valid Hindi state name
            'status' => 'required|in:0,1', // Status must be either 0 (Inactive) or 1 (Active)
        ], [
            'state_name.required' => 'The state name is required.',
            'state_name_hindi.required' => 'The state name required.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'The status must be either Active or Inactive.',
        ]);

        // Insert the validated data into the database
        DB::table('manage_state')->insert([
            'state_name' => $validatedData['state_name'],
            'state_name_hindi' => $validatedData['state_name_hindi'],
            'status' => $validatedData['status'],
        ]);

        // Log the insertion action in the audit table
        ManageAudit::create([
            'Module_Name' => 'State Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('state.index')->with('success', 'State added successfully.');
    }


    // state edit method to show the edit form for a specific section
    public function stateEdit($id)
    {

        $states = DB::table('manage_state')->where('id', $id)->first();
        return view('admin.manage_state.edit', compact('states'));
    }

    // state update method to handle form submission for updating section details

    public function stateUpdate(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'state_name' => "required|string|max:255",
            'state_name_hindi' => 'required|string|max:255', // Optional and valid Hindi state name
            'status' => 'required|in:0,1', // Status must be either 0 (Inactive) or 1 (Active)
        ], [
            'state_name.required' => 'The state name is required.',
            'state_name_hindi.required' => 'The state hindi name is required.',
            'status.required' => 'Please select a valid status.',
            'status.in' => 'The status must be either Active or Inactive.',
        ]);

        // Update the validated data in the database
        DB::table('manage_state')->where('id', $id)->update([
            'state_name' => $validatedData['state_name'],
            'state_name_hindi' => $validatedData['state_name_hindi'],
            'status' => $validatedData['status'],
        ]);

        // Log the update action in the audit table
        ManageAudit::create([
            'Module_Name' => 'State Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // ID of the authenticated user for update
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with a success message
        return redirect()->route('state.index')->with('success', 'State updated successfully.');
    }

    // state destroy method to delete a section
    public function stateDestroy($id)
    {
        // Check if the state exists
        $state = DB::table('manage_state')->where('id', $id)->first();
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($state->status == 1) {
            return redirect()->route('state.index')->with('error', 'Active states cannot be deleted.');
        }
        // Proceed with deletion if the state is active
        DB::table('manage_state')->where('id', $id)->delete();
        // Redirect with success message
        return redirect()->route('state.index')->with('success', 'State deleted successfully.');
    }


    public function districtIndex()
    {

        $districts = DB::table('manage_district')->get();
        return view('admin.manage_district.index', compact('districts'));
    }

    // state create method to show the create form
    public function districtCreate()
    {
        $statenames = DB::table('manage_state')->get();
        return view('admin.manage_district.create', compact('statenames'));
    }

    // district store method to handle form submission for creating new district
    public function districtStore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'state_name' => 'required|exists:manage_state,id', // Ensure that state_id is valid and exists
            'state_name' => 'required|string|max:255', // Ensure that state_id is valid and exists
            'district_name' => 'required|string|max:255', // Ensure that district_name is provided and is a string
            'district_name_hindi' => 'required|string|max:255', // Ensure that district_name is provided and is a string
            'status' => 'required|in:0,1', // Validate that status is either 0 (active) or 1 (inactive)
        ]);

        // Insert the district into the database
        DB::table('manage_district')->insert([
            'state_id' => $request->state_name,
            'district_name' => $request->district_name,
            'district_name_hindi' => $request->district_name_hindi,
            'status' => $request->status,
        ]);

        // Log the audit details
        ManageAudit::create([
            'Module_Name' => 'District Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user (you can replace `null` with an actual value)
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect with success message
        return redirect()->route('district.index')->with('success', 'District added successfully');
    }


    // state edit method to show the edit form for a specific section
    public function districtEdit($id)
    {

        $districts = DB::table('manage_district')->where('id', $id)->first();
        return view('admin.manage_district.edit', compact('districts'));
    }

    // state update method to handle form submission for updating section details
    public function districtUpdate(Request $request, $id)
    {
        $district = DB::table('manage_district')->where('id', $id)->update([
            // 'state_id' => $request->state_id,
            'district_name' => $request->district_name,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'District Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('district.index')->with('success', 'District updated successfully');
    }

    public function districtDestroy($id)
    {
        // Find the district by its ID
        $district = DB::table('manage_district')->where('id', $id)->first();
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($district && $district->status == 1) {
            return redirect()->route('district.index')->with('error', 'Active districts cannot be deleted.');
        }
        // Proceed with deleting the district if the status is not 1 (Active)
        DB::table('manage_district')->where('id', $id)->delete();
        // Return success message
        return redirect()->route('district.index')->with('success', 'District deleted successfully');
    }



    public function examIndex()
    {

        $exams = DB::table('manage_exam')->get();
        return view('admin.manage_exam.index', compact('exams'));
    }

    // state create method to show the create form
    public function examCreate()
    {
        $exams = DB::table('manage_exam')->get();
        return view('admin.manage_exam.create', compact('exams'));
    }


    public function examStore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'txtlanguage' => 'required|string|max:255',       // Language (required, string, max length 255)
            'exm_code' => 'required|string|max:50',            // Exam Code (required, string, max length 50)
            'exm_user_id' => 'required', // User ID (required, integer, must exist in the users table)
            'exm_date' => 'required|date_format:d-m-Y', // Ensure the date is in the correct format
            'status' => 'required|boolean',                    // Status (required, boolean)
        ]);

        // If validation fails, Laravel will automatically redirect with error messages

        // If validation passes, proceed with storing the data
        $exam = DB::table('manage_exam')->insert([
            'language' => $request->txtlanguage,
            'exam_code' => $request->exm_code,
            'exam_description' => $request->exm_desc,
            'user_id' => $request->exm_user_id,
            'transaction_date' => $request->exm_date,
            'preliminary_flag' => $request->preliminary_flag,
            'main_flag' => $request->main_flag,
            'status' => $request->status,
        ]);

        // Log the action in the ManageAudit table
        ManageAudit::create([
            'Module_Name' => 'Exam Module', // Static value
            'Time_Stamp' => time(),         // Current timestamp
            'Created_By' => null,           // ID of the authenticated user (optional)
            'Updated_By' => null,           // No update on creation, so leave null
            'Action_Type' => 'Insert',      // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Return success message and redirect to the exam index page
        return redirect()->route('exam.index')->with('success', 'Exam added successfully');
    }


    // state edit method to show the edit form for a specific section
    public function examEdit($id)
    {
        $exams = DB::table('manage_exam')->where('id', $id)->first();
        return view('admin.manage_exam.edit', compact('exams'));
    }

    public function examUpdate(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'txtlanguage' => 'required|string|max:255',   // Language is required and must be a string
            'exm_code' => 'required|string|max:50',      // Exam code is required and must be a string
            'exm_desc' => 'nullable|string|max:500',     // Exam description is optional but must be a string
            'exm_user_id' => 'required|integer',         // User ID is required and must be an integer
            'exm_date' => 'required|date_format:d-m-Y',  // Transaction date must follow DD-MM-YYYY format
            'status' => 'required|integer|in:0,1',       // Status must be 0 or 1
        ]);

        // Convert the date to "YYYY-MM-DD" format for database storage
        $formattedDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->exm_date)->format('Y-m-d');

        // Update the exam record in the database
        DB::table('manage_exam')->where('id', $id)->update([
            'language' => $request->txtlanguage,
            'exam_code' => $request->exm_code,
            'exam_description' => $request->exm_desc,
            'user_id' => $request->exm_user_id,
            'transaction_date' => $formattedDate,
            'preliminary_flag' => $request->preliminary_flag,
            'main_flag' => $request->main_flag,
            'status' => $request->status,
        ]);

        // Log the update in the audit table
        ManageAudit::create([
            'Module_Name' => 'Exam Module', 
            'Time_Stamp' => time(), 
            'Created_By' => null,  // Assuming created by is null for updates
            'Updated_By' => null,  // Assuming updated by is null for now
            'Action_Type' => 'Update', 
            'IP_Address' => $request->ip(),
        ]);

        // Redirect back with success message
        return redirect()->route('exam.index')->with('success', 'Exam updated successfully');
    }

    public function examDestroy($id)
    {
        // Retrieve the exam record
        $exam = DB::table('manage_exam')->where('id', $id)->first();

        // Check if the exam is inactive (status == 1) and prevent deletion
        if ($exam && $exam->status == 1) {
            return redirect()->route('exam.index')->with('error', 'Active exams cannot be deleted.');
        }

        // Proceed to delete the record if the status check passes
        DB::table('manage_exam')->where('id', $id)->delete();

        // Redirect back with success message
        return redirect()->route('exam.index')->with('success', 'Exam deleted successfully.');
    }



}
