<?php
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\TrainingProgram;
use Illuminate\Http\Request;

use App\Models\Admin\Micro\ManageAudit;
use Illuminate\Support\Facades\Auth;

class TrainingProgramController extends Controller
{
    public function index()
    {
        $programs = TrainingProgram::all();
        return view('admin.micro.training_program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.micro.training_program.create');
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

    public function edit(TrainingProgram $trainingProgram)
    {
        return view('admin.micro.training_program.edit', compact('trainingProgram'));
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
