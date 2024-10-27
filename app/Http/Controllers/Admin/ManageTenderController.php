<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageTender;
use Illuminate\Http\Request;

class ManageTenderController extends Controller
{
    // Show all tenders/circulars
    public function index()
    {
        $tenders = ManageTender::all();
        return view('manage_tender.index', compact('tenders'));
    }

    // Show form for creating a new tender
    public function create()
    {
        return view('manage_tender.create');
    }

    // Store the newly created tender
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
	        'language' => 'required',
	        'type' => 'required',
	        'title' => 'required|string|max:255',
	        'description' => 'required|string',
	        'file' => 'required|mimes:pdf,png,jpg|max:2048',
	        'publish_date' => 'required|date',
	        'expiry_date' => 'required|date|after_or_equal:publish_date',
	        'status' => 'required|in:Draft,Approval,Publish',
	    ]);

        // Handle file upload
        // if ($request->hasFile('file')) {
        //     $filename = $request->file->store('uploads', 'public');
        // } else {
        //     $filename = null;
        // }

        if ($request->hasFile('file')) {
	        $filename = time() . '.' . $request->file->extension();
	        $request->file->move(storage_path('app/public/uploads'), $filename);
	        $validated['file'] = $filename;
	    }

        // Save the tender
        ManageTender::create([
            'language' => $request->language,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'publish_date' => $request->publish_date,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);

        return redirect()->route('manage_tender.index')->with('success', 'Tender created successfully.');
    }

    // Show a specific tender
    public function show(ManageTender $manageTender)
    {
        return view('manage_tender.show', compact('manageTender'));
    }

    // Show form to edit a specific tender
    public function edit(ManageTender $manageTender)
    {
        return view('manage_tender.edit', compact('manageTender'));
    }

    // Update the tender
    public function update(Request $request, ManageTender $manageTender)
    {
        $request->validate([
	        'language' => 'required',
	        'type' => 'required',
	        'title' => 'required|string|max:255',
	        'description' => 'required|string',
	        'file' => 'nullable|mimes:pdf,png,jpg|max:2048',
	        'publish_date' => 'required|date',
	        'expiry_date' => 'required|date|after_or_equal:publish_date',
	        'status' => 'required|in:Draft,Approval,Publish',
	    ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filename = $request->file->store('uploads', 'public');
        } else {
            $filename = $manageTender->file;
        }

        // Update the tender
        $manageTender->update([
            'language' => $request->language,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'file' => $filename,
            'publish_date' => $request->publish_date,
            'expiry_date' => $request->expiry_date,
            'status' => $request->status,
        ]);

        return redirect()->route('manage_tender.index')->with('success', 'Tender updated successfully.');
    }

    // Delete the tender
    public function destroy(ManageTender $manageTender)
    {
        $manageTender->delete();
        return redirect()->route('manage_tender.index')->with('success', 'Tender deleted successfully.');
    }
}
