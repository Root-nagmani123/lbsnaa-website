<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ManageOrganiser;
use Illuminate\Http\Request;

class OrganiserController extends Controller
{
    // Display a listing of organisers
    public function index()
    {
        $organisers = ManageOrganiser::all();
        return view('admin.training_master.manage_organiser.index', compact('organisers'));
    }

    // Show form for creating a new organiser
    public function create()
    {
        return view('admin.training_master.manage_organiser.create');
    }

    // Store a new organiser
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'organiser_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        ManageOrganiser::create($request->all());
        return redirect()->route('organisers.index')->with('success', 'Organiser created successfully.');

    }

    // Show the form for editing an organiser
    public function edit($id)
    {
        $organiser = ManageOrganiser::findOrFail($id);
        return view('admin.training_master.manage_organiser.edit', compact('organiser'));
    }

    // Update the organiser
    public function update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required',
            'organiser_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $organiser = ManageOrganiser::findOrFail($id);
        $organiser->update($request->all());
        return redirect()->route('organisers.index')->with('success', 'Organiser updated successfully.');
    }

    // Delete an organiser
    public function destroy($id)
    {
        $organiser = ManageOrganiser::findOrFail($id);
        $organiser->delete();
        return redirect()->route('organisers.index')->with('success', 'Organiser deleted successfully.');
    }
}
