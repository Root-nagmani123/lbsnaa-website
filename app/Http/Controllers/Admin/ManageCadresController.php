<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageCadres;

class ManageCadresController extends Controller
{
    // Display the list of cadres
    public function index()
    {
        $cadres = ManageCadres::all();
        return view('admin.training_master.cadres.index', compact('cadres'));
    }

    // Show form for creating new cadre
    public function create()
    {
        return view('admin.training_master.cadres.create');
    }

    // Store new cadre
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ]);

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 2;
        ManageCadres::create($request->all());
        return redirect()->route('cadres.index')->with('success', 'Cadre added successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $cadre = ManageCadres::find($id);
        return view('admin.training_master.cadres.edit', compact('cadre'));
    }

    // Update cadre details
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'language' => 'required',
            'status' => 'required|string',
        ]);

        // Convert status to integer
        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $cadre = ManageCadres::find($id);
        $cadre->update($request->all());
        return redirect()->route('cadres.index')->with('success', 'Cadre updated successfully');
    }

    // Delete cadre
    public function destroy($id)
    {
        ManageCadres::destroy($id);
        return redirect()->route('cadres.index')->with('success', 'Cadre deleted successfully');
    }
}
