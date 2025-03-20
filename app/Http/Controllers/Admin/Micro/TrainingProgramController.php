<?php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class TrainingProgramController extends Controller
{
    public function index()
    {
        $programs = DB::table('micro_manage_training_programs as tp')
            ->leftJoin('research_centres as rc', 'tp.research_centre', '=', 'rc.id') // Adjust column names as needed
            ->select('tp.*', 'rc.research_centre_name as research_centre_name') // Include the name of the research centre
            ->get();
        return view('admin.micro.training_program.index', compact('programs'));
    }
 
    public function create()
    {
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Add the condition to filter by status
            ->pluck('research_centre_name', 'id'); // Replace 'research_centre_name' and 'id' with your actual column names.
        
        return view('admin.micro.training_program.create', compact('researchCentres'));
    }



    public function store(Request $request)
    {
        $rules = [
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'program_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'program_coordinator' => 'nullable|string|max:255',
            'program_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'registration_status' => 'required|integer|in:1,2',
            'page_status' => 'required|integer|in:1,0',
        ];
        
        $messages = [
            'research_centre.required' => 'Please select a research centre.',
            'research_centre.string' => 'Research centre must be a valid string.',
            'research_centre.max' => 'Research centre cannot exceed 255 characters.',
        
            'language.required' => 'Please select a language.',
            'language.integer' => 'The language must be a valid number.',
            'language.in' => 'Invalid language selection.',
        
            'program_name.required' => 'Please enter the program name.',
            'program_name.string' => 'Program name must be a valid string.',
            'program_name.max' => 'Program name cannot exceed 255 characters.',
        
            'venue.required' => 'Please enter the venue.',
            'venue.string' => 'Venue must be a valid string.',
            'venue.max' => 'Venue cannot exceed 255 characters.',
        
            'program_coordinator.string' => 'Program coordinator must be a valid string.',
            'program_coordinator.max' => 'Program coordinator cannot exceed 255 characters.',
        
            'program_description.required' => 'Please enter a program description.',
            'program_description.string' => 'Program description must be a valid string.',
        
            'start_date.required' => 'Please select a start date.',
            'start_date.date' => 'Start date must be a valid date.',
        
            'end_date.required' => 'Please select an end date.',
            'end_date.date' => 'End date must be a valid date.',
        
            'registration_status.required' => 'Please select the registration status.',
            'registration_status.integer' => 'The registration status must be a valid number.',
            'registration_status.in' => 'Invalid registration status selection.',
        
            'page_status.required' => 'Please select the page status.',
            'page_status.integer' => 'The page status must be a valid number.',
            'page_status.in' => 'Invalid page status selection.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated();

        TrainingProgram::create($request->all());

        MicroManageAudit::create([
            'Module_Name' => 'Training Program', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('training-programs.index')->with('success', 'Training Program added successfully.');
    }



    public function edit($id)
    {
        // Fetch the specific training program by ID
        $trainingProgram = TrainingProgram::findOrFail($id); 

        // Fetch the research centers
        $researchCentres = DB::table('research_centres')
            ->select('id', 'research_centre_name')
            ->pluck('research_centre_name', 'id') // Retrieves an associative array of id => name
            ->toArray();
        // Pass the variables to the Blade file
        return view('admin.micro.training_program.edit', compact('trainingProgram', 'researchCentres'));
    }
 


    public function update(Request $request, TrainingProgram $trainingProgram)
    {
        $rules = [
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'program_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'program_coordinator' => 'nullable|string|max:255',
            'program_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'registration_status' => 'required|integer|in:1,2',
            'page_status' => 'required|integer|in:1,0',
        ];
        
        $messages = [
            'research_centre.required' => 'Please select a research centre.',
            'research_centre.string' => 'Research centre must be a valid string.',
            'research_centre.max' => 'Research centre cannot exceed 255 characters.',
        
            'language.required' => 'Please select a language.',
            'language.integer' => 'The language must be a valid number.',
            'language.in' => 'Invalid language selection.',
        
            'program_name.required' => 'Please enter the program name.',
            'program_name.string' => 'Program name must be a valid string.',
            'program_name.max' => 'Program name cannot exceed 255 characters.',
        
            'venue.required' => 'Please enter the venue.',
            'venue.string' => 'Venue must be a valid string.',
            'venue.max' => 'Venue cannot exceed 255 characters.',
        
            'program_coordinator.string' => 'Program coordinator must be a valid string.',
            'program_coordinator.max' => 'Program coordinator cannot exceed 255 characters.',
        
            'program_description.required' => 'Please enter a program description.',
            'program_description.string' => 'Program description must be a valid string.',
        
            'start_date.required' => 'Please select a start date.',
            'start_date.date' => 'Start date must be a valid date.',
        
            'end_date.required' => 'Please select an end date.',
            'end_date.date' => 'End date must be a valid date.',
        
            'registration_status.required' => 'Please select the registration status.',
            'registration_status.integer' => 'The registration status must be a valid number.',
            'registration_status.in' => 'Invalid registration status selection.',
        
            'page_status.required' => 'Please select the page status.',
            'page_status.integer' => 'The page status must be a valid number.',
            'page_status.in' => 'Invalid page status selection.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $validator->validated(); 

        $trainingProgram->update($request->all());

        MicroManageAudit::create([
            'Module_Name' => 'Training Program', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('training-programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(TrainingProgram $trainingProgram)
    {
        // Check if the status is 1 (Inactive) and prevent deletion
        if ($trainingProgram->page_status == 1) {
            return redirect()->route('training-programs.index')->with('error', 'Active programs cannot be deleted.');
        }

        // Proceed with deletion if the status is not 1
        $trainingProgram->delete();
        return redirect()->route('training-programs.index')->with('success', 'Program deleted successfully.');
    }

}
