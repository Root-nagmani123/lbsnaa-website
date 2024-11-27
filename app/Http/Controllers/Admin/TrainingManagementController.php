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
        $category = DB::table('manage_category')->insert([
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
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('category.index')->with('success', 'Category added successfully');
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
        DB::table('manage_category')->where('id', $id)->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
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

    // country store method to handle form submission for creating new section
    public function countryStore(Request $request)
    {

        $country = DB::table('manage_country')->insert([
            'country_name' => $request->country_name,
            'country_name_hindi' => $request->country_name_hindi,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'Country Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('country.index')->with('success', 'country added successfully');
    }

    // country edit method to show the edit form for a specific section
    public function countryEdit($id)
    {

        $country = DB::table('manage_country')->where('id', $id)->first();
        return view('admin.manage_country.edit', compact('country'));
    }

    // country update method to handle form submission for updating section details
    public function countryUpdate(Request $request, $id)
    {
        $country = DB::table('manage_country')->where('id', $id)->update([
            'country_name' => $request->country_name,
            'country_name_hindi' => $request->country_name_hindi,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'Country Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('country.index')->with('success', 'country updated successfully');
    }

    // country destroy method to delete a section
    public function countryDestroy($id)
    {
        DB::table('manage_country')->where('id', $id)->delete();
        return redirect()->route('country.index')->with('success', 'country deleted successfully');
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

    // state store method to handle form submission for creating new section
    public function stateStore(Request $request)
    {

        $state = DB::table('manage_state')->insert([
            'state_name' => $request->state_name,
            'state_name_hindi' => $request->state_name_hindi,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'State Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('state.index')->with('success', 'state added successfully');
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
        $state = DB::table('manage_state')->where('id', $id)->update([
            'state_name' => $request->state_name,
            'state_name_hindi' => $request->state_name_hindi,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'State Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('state.index')->with('success', 'state updated successfully');
    }

    // state destroy method to delete a section
    public function stateDestroy($id)
    {
        DB::table('manage_state')->where('id', $id)->delete();
        return redirect()->route('state.index')->with('success', 'state deleted successfully');
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

    // state store method to handle form submission for creating new section
    public function districtStore(Request $request)
    {

        $district = DB::table('manage_district')->insert([
            'state_id' => $request->state_name,
            'district_name' => $request->district_name,
            'status' => $request->status,
        ]);

        ManageAudit::create([
            'Module_Name' => 'District Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

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

    // state destroy method to delete a section
    public function districtDestroy($id)
    {
        DB::table('manage_district')->where('id', $id)->delete();
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

    // state store method to handle form submission for creating new section
    public function examStore(Request $request)
    {
        $exam = DB::table('manage_exam')->insert([
            'language' => $request->txtlanguage, // Exam language
            'exam_code' => $request->exm_code, // Exam Code
            'exam_description' => $request->exm_desc, // Exam Description (nullable)
            'user_id' => $request->exm_user_id, // User ID
            'transaction_date' => $request->exm_date, // Transaction Date
            'preliminary_flag' => $request->preliminary_flag, // Preliminary Flag
            'main_flag' => $request->main_flag, // Main Flag
            'status' => $request->status, // Status
        ]);

        ManageAudit::create([
            'Module_Name' => 'Exam Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('exam.index')->with('success', 'Exams added successfully');
    }

    // state edit method to show the edit form for a specific section
    public function examEdit($id)
    {

        $exams = DB::table('manage_exam')->where('id', $id)->first();
        return view('admin.manage_exam.edit', compact('exams'));
    }

    // state update method to handle form submission for updating section details
    public function examUpdate(Request $request, $id)
    {
        $exam = DB::table('manage_exam')->where('id', $id)->update([
            'language' => $request->txtlanguage, // Exam language
            'exam_code' => $request->exm_code, // Exam Code
            'exam_description' => $request->exm_desc, // Exam Description (nullable)
            'user_id' => $request->exm_user_id, // User ID
            'transaction_date' => $request->exm_date, // Transaction Date
            'preliminary_flag' => $request->preliminary_flag, // Preliminary Flag
            'main_flag' => $request->main_flag, // Main Flag
            'status' => $request->status, // Status
        ]);

        ManageAudit::create([
            'Module_Name' => 'Exam Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('exam.index')->with('success', 'Exams updated successfully');
    }

    // state destroy method to delete a section
    public function examDestroy($id)
    {
        DB::table('manage_exam')->where('id', $id)->delete();
        return redirect()->route('exam.index')->with('success', 'Exams deleted successfully');
    }
}
