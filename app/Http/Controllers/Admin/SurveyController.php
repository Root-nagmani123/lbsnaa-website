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
            'survey_title' => 'required',
            'startdate' => 'required|date',
            'expairydate' => 'required|date|after_or_equal:startdate',
            'status' => 'required',
        ]);

        // Insert the survey data into the database
        $survey = DB::table('manage_surveys')->insert([
            'survey_title' => $request->survey_title,
            'start_date' => $request->startdate,
            'end_date' => $request->expairydate,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ManageAudit::create([
            'Module_Name' => 'Survey Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($survey), // Save state as JSON
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
        'survey_title' => 'required',
        'startdate' => 'required|date',
        'expairydate' => 'required|date|after_or_equal:startdate',
        'status' => 'required',
    ]);

    // Update the survey data in the database
    $survey = DB::table('manage_surveys')->where('id', $id)->update([
        'survey_title' => $request->survey_title,
        'start_date' => $request->startdate,
        'end_date' => $request->expairydate,
        'status' => $request->status,
        'updated_at' => now(),
    ]);

    ManageAudit::create([
        'Module_Name' => 'Survey Module', // Static value
        'Time_Stamp' => now(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Update', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
        'Current_State' => json_encode($survey), // Save state as JSON
    ]);

    // Optionally, you can redirect back or to another route
    return redirect()->route('survey.index')->with('success', 'Survey updated successfully!');
}


    // Category destroy method to delete a section
    public function surveyDestroy($id)
    {
        DB::table('manage_surveys')->where('id', $id)->delete();
        return redirect()->route('survey.index')->with('success', 'Survey deleted successfully');
    }
}