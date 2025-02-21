<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class SurveyController extends Controller
{
    public function surveyIndex()
    {

        $survey = DB::table('manage_surveys')->get();
        return view('admin.manage_survey.index', compact('survey'));
    }

    // Category create method to show the create form
    public function surveyCreate()
    {
        return view('admin.manage_survey.create');
    }

    // Category store method to handle form submission for creating new section
    public function surveyStore(Request $request)
    {
        $rules = [
            'language' => 'required',
            'survey_title' => 'required',
            'startdate' => 'required|date',
            'expairydate' => 'required|date|after_or_equal:startdate',
            'status' => 'required',
        ];
    
        // ✅ Define custom messages (optional)
        $messages = [
            'language.required' => 'Please select a language.',
            'survey_title.required' => 'Survey title is required.',
            'startdate.required' => 'Start date is required.',
            'expairydate.required' => 'Expiry date is required.',
            'expairydate.after_or_equal' => 'Expiry date must be after or equal to the start date.',
            'status.required' => 'Status is required.',
        ];
    
        // ✅ Create validator instance
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }       

        // Insert the survey data into the database
        $survey = DB::table('manage_surveys')->insert([
            'language' => $request->language,
            'survey_title' => $request->survey_title,
            'start_date' => $request->startdate,
            'end_date' => $request->expairydate,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ManageAudit::create([
            'Module_Name' => 'Survey Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Survey added successfully!', 1);

        return redirect()->route('survey.index');
    }

    // Category edit method to show the edit form for a specific section
    public function surveyEdit($id)
    {

        $survey = DB::table('manage_surveys')->where('id', $id)->first();
        return view('admin.manage_survey.edit', compact('survey'));
    }

   // Update method to handle form submission for updating an existing survey
    public function surveyUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $rules = [
            'language' => 'required',
            'survey_title' => 'required',
            'startdate' => 'required|date',
            'expairydate' => 'required|date|after_or_equal:startdate',
            'status' => 'required',
        ];
    
        // ✅ Define custom messages (optional)
        $messages = [
            'language.required' => 'Please select a language.',
            'survey_title.required' => 'Survey title is required.',
            'startdate.required' => 'Start date is required.',
            'expairydate.required' => 'Expiry date is required.',
            'expairydate.after_or_equal' => 'Expiry date must be after or equal to the start date.',
            'status.required' => 'Status is required.',
        ];
    
        // ✅ Create validator instance
        $validator = Validator::make($request->all(), $rules, $messages);
    

        // Update the survey data in the database
        $survey = DB::table('manage_surveys')->where('id', $id)->update([
            'language' => $request->language,
            'survey_title' => $request->survey_title,
            'start_date' => $request->startdate,
            'end_date' => $request->expairydate,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        ManageAudit::create([
            'Module_Name' => 'Survey Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Survey updated successfully!', 1);

        // Optionally, you can redirect back or to another route
        return redirect()->route('survey.index');
    }

    public function surveyDestroy($id)
    {
        // Retrieve the survey record to check its status
        $survey = DB::table('manage_surveys')->where('id', $id)->first();

        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($survey && $survey->status == 1) {
        Cache::put('error_message', 'Active surveys cannot be deleted!', 1);

            return redirect()->route('survey.index');
        }

        // Proceed with deletion if status is not 1
        DB::table('manage_surveys')->where('id', $id)->delete();
        Cache::put('success_message', 'Survey deleted successfully!', 1);

        return redirect()->route('survey.index');
    }

}
