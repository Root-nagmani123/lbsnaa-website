<?php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\ManageAudit;
use Illuminate\Support\Facades\Auth;

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
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        return view('admin.micro.training_program.create',compact('researchCentres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'program_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'program_coordinator' => 'nullable|string|max:255',
            'program_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_status' => 'required|integer|in:1,2',
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        TrainingProgram::create($request->all());
        return redirect()->route('training-programs.index')->with('success', 'Program added successfully.');
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
        $request->validate([
            'research_centre' => 'required|string|max:255',
            'language' => 'required|integer|in:1,2',
            'program_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'program_coordinator' => 'nullable|string|max:255',
            'program_description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_status' => 'required|integer|in:1,2',
            'page_status' => 'required|integer|in:1,2,3',
        ]);

        $trainingProgram->update($request->all());
        return redirect()->route('training-programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(TrainingProgram $trainingProgram)
    {
        $trainingProgram->delete();
        return redirect()->route('training-programs.index')->with('success', 'Program deleted successfully.');
    }
}
