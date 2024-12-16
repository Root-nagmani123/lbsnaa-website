<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'language' => 'required',
            'survey_title' => 'required',
            'startdate' => 'required|date',
            'expairydate' => 'required|date|after_or_equal:startdate',
            'status' => 'required',
        ]); 

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

        return redirect()->route('survey.index')->with('success', 'Survey added successfully');
    }

    // Category edit method to show the edit form for a specific section
    public function surveyEdit($id)
    {

        $survey = DB::table('manage_surveys')->where('id', $id)->first();
        return view('admin.manage_survey.edit', compact('survey'));
    }

    // Category update method to handle form submission for updating section details
   // Update method to handle form submission for updating an existing survey
    public function surveyUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'language' => 'required',
            'survey_title' => 'required',
            'startdate' => 'required|date',
            'expairydate' => 'required|date|after_or_equal:startdate',
            'status' => 'required',
        ]);

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

        // Optionally, you can redirect back or to another route
        return redirect()->route('survey.index')->with('success', 'Survey updated successfully!');
    }

    public function surveyDestroy($id)
    {
        // Retrieve the survey record to check its status
        $survey = DB::table('manage_surveys')->where('id', $id)->first();

        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($survey && $survey->status == 1) {
            return redirect()->route('survey.index')->with('error', 'Inactive surveys cannot be deleted.');
        }

        // Proceed with deletion if status is not 1
        DB::table('manage_surveys')->where('id', $id)->delete();

        return redirect()->route('survey.index')->with('success', 'Survey deleted successfully');
    }

}
