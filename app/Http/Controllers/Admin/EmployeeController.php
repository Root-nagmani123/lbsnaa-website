<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    // Display form

    public function organisation_chartIndex()
    {

        $records = DB::table('organisation_chart')
        ->leftJoin('faculty_members', 'organisation_chart.faculty_id', '=', 'faculty_members.id')
        ->where('organisation_chart.category', 0)
        ->select('organisation_chart.*','faculty_members.name')
        ->get();
        return view('admin.manage_organisationchart.index', compact('records'));
    }

    // Category create method to show the create form
    public function organisation_chartCreate(Request $request)
    {
        $parent_id = !empty($request->query('parent_id')) ? $request->query('parent_id') : '';
        $records = DB::table('faculty_members')->where('page_status',1)->get();
        $organisation_chart = DB::table('organisation_chart')->where('status',1)->where('id',$parent_id)->first();
        return view('admin.manage_organisationchart.create', compact('records', 'parent_id','organisation_chart'));
    }

    // Category store method to handle form submission for creating new section
    public function organisation_chartStore(Request $request)
    {
        $rules = [
            'language' => 'required',
            'parentcategory' => 'required',
            'employee_name' => 'required',
            'description' => 'nullable|string',
            'category' => 'nullable',
            'status' => 'required|in:0,1',
        ];
    
        $messages = [
            'language.required' => 'Language is required.',
            'parentcategory.required' => 'Parent category is required.',
            'employee_name.required' => 'Employee name is required.',
            'description.string' => 'Description must be a valid string.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selection.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // Store validation errors and old inputs in cache (for 1 minute)
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        // dd($sss);


        DB::table('organisation_chart')->insert([
            'language' => $request->input('language'),
            'faculty_id' => $request->input('parentcategory'),
            'parent_id' => $request->input('parent_id'),
            'employee_name' => $request->input('employee_name'),
            'description' => $request->input('description'),
            'category' => isset($request->category) ? $request->category : 1,
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ManageAudit::create([
            'Module_Name' => 'Organisation Chart', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        
      
        Cache::put('success_message', 'Employee added successfully', 1);
        // Redirect back to the same URL
        return redirect()->route('organisation-chart.sub-org', ['parent_id' => $request->input('parent_id')]); 
    }

    // Category edit method to show the edit form for a specific section

    public function organisation_chartEdit($id)
    {
        $record = DB::table('organisation_chart')->where('id', $id)->first();
        $faculty = DB::table('faculty_members')->get();
        $parent_id = $record->parent_id; // Retrieve parent_id from the record

        // Pass $parent_id to the view
        return view('admin.manage_organisationchart.edit', compact('record', 'faculty', 'parent_id'));
    }


    public function organisation_chartUpdate(Request $request, $id)
    {
        // Validate the request data
        $rules = [
            'language' => 'required',
            'parentcategory' => 'required',
            'employee_name' => 'required',
            'description' => 'nullable|string',
            'category' => 'nullable',
            'status' => 'required|in:0,1',
        ];
    
        $messages = [
            'language.required' => 'Language is required.',
            'parentcategory.required' => 'Parent category is required.',
            'employee_name.required' => 'Employee name is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selection.',
        ];
        $request->validate([
            'language' => 'required',
            'parentcategory' => 'required',
            'employee_name' => 'required',
            'description' => 'nullable|string',
            'category' => 'nullable', 
            'status' => 'required|in:0,1',
        ]);
        // Validate Request
        // $validator = Validator::make($request->all(), $rules, $messages);
    
        // if ($validator->fails()) {
        //     // Store validation errors, old inputs, and error message in cache (for 1 minute)
        //     Cache::put('validation_errors', $validator->errors()->toArray(), 1);
        //       return redirect(session('url.previousdata', url('/')));
        // }

        // Check if the record exists
        $organisationChart = DB::table('organisation_chart')->where('id', $id)->first();

        if (!$organisationChart) {
            Cache::put('error_message', 'Record not found.', 1);
            return redirect()->route('organisation_chart.index');
        }

        // Set category based on the condition
        $category = ($id == 1) ? 0 : 1;

        // Prepare data for update
        $data = [
            'language' => $request->language,
            'faculty_id' => $request->parentcategory,
            'parent_id' => $request->parent_id,
            'employee_name' => $request->employee_name,
            'description' => $request->description,
            'category' => $category,
            'status' => $request->status,
            'updated_at' => now(), // Manually setting the updated_at timestamp
        ];

        // Log the update in the ManageAudit table
        ManageAudit::create([
            'Module_Name' => 'Organisation Chart', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Perform the update in the database using the query builder
        $updated = DB::table('organisation_chart')->where('id', $id)->update($data);

        // Check if the update was successful
        if ($updated) {
            Cache::put('success_message', 'Employee updated successfully!', 1);
            return redirect()->route('organisation-chart.sub-org', ['parent_id' => $request->input('parent_id')]);
        } else {
            Cache::put('error_message', 'Failed to update record.', 1);
            return redirect()->route('organisation-chart.index');
        }
    }

    public function organisation_chartDestroy($id)
    {
        // dd($id);
        // Retrieve the record to ensure it exists and to check its status
        $organisationChart = DB::table('organisation_chart')->where('id', $id)->first();
$parent_id = $organisationChart->parent_id;
        if (!$organisationChart) {
            Cache::put('error_message', 'Record not found.', 1);
            return redirect()->route('organisation-chart.sub-org', ['parent_id' => $parent_id]);
        }

        // Check if the status is 1 (Inactive)
        if ($organisationChart->status == 1) {
            Cache::put('error_message', 'Active organisation charts cannot be deleted.', 1);
            return redirect()->route('organisation-chart.sub-org', ['parent_id' => $parent_id]);
        }

        // Perform the delete operation
        $deleted = DB::table('organisation_chart')->where('id', $id)->delete();

        if ($deleted) {
            // return redirect()->route('organisation_chart.sub_org', ['parent_id' => $request->input('parent_id')])
            // ->with('success', 'Employee Deleted successfully');
        Cache::put('success_message', 'Deleted successfully.', 1);

            return redirect()->route('organisation-chart.sub-org', ['parent_id' => $parent_id]);
        } else {
            Cache::put('error_message', 'Failed to delete record.', 1);
            return redirect()->route('organisation-chart.sub-org', ['parent_id' => $parent_id])->with('error', 'Failed to delete the record');
        }
    }


    public function autocompleteEmployees(Request $request)
    {
        $term = $request->get('term');
        $employees = DB::table('faculty_members') // Replace 'employees' with your actual table name
            ->where('name', 'LIKE', '%' . $term . '%')
            ->pluck('name'); // Adjust the column name if it's not `name`NULL

        return response()->json($employees);
    }

    public function showSubOrg($parent_id)
    {

        
        // Fetch records based on the parent_id
        // $records = DB::table('organisation_chart')
        //     ->where('parent_id', $parent_id)
        //     ->get();
        // $employeeNames = DB::table('organisation_chart')
        //     ->where('id', $parent_id)
        //     ->value('employee_name');

            // $records = DB::table('organisation_chart')
            // ->leftJoin('faculty_members', 'organisation_chart.faculty_id', '=', 'faculty_members.id')
            // ->where('organisation_chart.parent_id', $parent_id)
            // ->select('organisation_chart.*','faculty_members.name')
            // ->get();

            $records = DB::table('organisation_chart as oc')
                ->leftJoin('faculty_members as fm1', 'oc.employee_name', '=', 'fm1.id')
                ->leftJoin('faculty_members as fm2', 'oc.faculty_id', '=', 'fm2.id')
                ->where('oc.parent_id', $parent_id)
                ->orderBy('oc.position', 'ASC')
                ->select(
                    'oc.*',
                    'fm1.name as employeeNames',
                    'fm2.name as faculty_id_faculty'
                )
                ->get();

        return view('admin.manage_organisationchart.sub_org', compact('records','parent_id'));
    }
}
