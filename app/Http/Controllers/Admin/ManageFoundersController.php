<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageFounders;
use Illuminate\Http\Request;

class ManageFoundersController extends Controller
{
    // Display the list of founders
    public function index()
    {
        $founders = ManageFounders::all();
        return view('training_master.founders.index', compact('founders'));
    }

    // Show the form to create a new founder
    public function create()
    {
        return view('training_master.founders.create');
    }

    // Store the new founder in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'language' => 'required',
            'status' => 'required',
        ]);

        ManageFounders::create($request->all());
        return redirect()->route('founders.index')->with('success', 'Founder added successfully.');
    }

    // Show the form to edit an existing founder
    public function edit($id)
    {
        $founder = ManageFounders::findOrFail($id);
        return view('training_master.founders.edit', compact('founder'));
    }

    // Update the founder's details
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'language' => 'required',
            'status' => 'required',
        ]);

        $founder = ManageFounders::findOrFail($id);
        $founder->update($request->all());
        return redirect()->route('founders.index')->with('success', 'Founder updated successfully.');
    }

    // Delete a founder from the database
    public function destroy($id)
    {
        $founder = ManageFounders::findOrFail($id);
        $founder->delete();
        return redirect()->route('founders.index')->with('success', 'Founder deleted successfully.');
    }
}
