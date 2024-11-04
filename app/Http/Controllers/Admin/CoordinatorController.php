<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageCoordinator;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function index()
    {
        $coordinators = ManageCoordinator::all();
        return view('admin.training_master.manage_coordinator.index', compact('coordinators'));
    }

    public function create()
    {
        return view('admin.training_master.manage_coordinator.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_language' => 'required|string',
            'coordinator_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        ManageCoordinator::create($request->all());
        return redirect()->route('coordinators.index')->with('success', 'Coordinator added successfully.');
    }

    public function edit($id)
    {
        $coordinator = ManageCoordinator::findOrFail($id);
        return view('admin.training_master.manage_coordinator.edit', compact('coordinator'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'page_language' => 'required|string',
            'coordinator_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $validated['status'] = $request->status === 'active' ? 1 : 2;
        $coordinator = ManageCoordinator::findOrFail($id);
        $coordinator->update($request->all());
        return redirect()->route('coordinators.index')->with('success', 'Coordinator updated successfully.');
    }

    public function destroy($id)
    {
        $coordinator = ManageCoordinator::findOrFail($id);
        $coordinator->delete();
        return redirect()->route('coordinators.index')->with('success', 'Coordinator deleted successfully.');
    }
}
