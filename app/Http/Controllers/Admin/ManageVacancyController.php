<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class ManageVacancyController extends Controller
{
    public function index()
    {
        $vacancies = ManageVacancy::all();
        return view('admin.manage_vacancy.index', compact('vacancies'));
    }

    public function create()
    {
        return view('admin.manage_vacancy.create');
    }



    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'language' => 'required',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,0',
        ];
    
        // Conditionally add validation for either document_upload or website_link
        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg|max:2048'; // Required if PDF is selected
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url'; // Required if Website is selected
        }
    
        // Custom error messages
        $messages = [
            'language.required' => 'Select a Language',
            'job_title.required' => 'Enter Job Title',
            'job_description.required' => 'Enter Job Description',
            'content_type.required' => 'Select Content Type',
            'publish_date.required' => 'Enter Publish Date',
            'expiry_date.required' => 'Enter Expiry Date',
            'expiry_date.after_or_equal' => 'Expiry Date must be after or equal to Publish Date',
            'status.required' => 'Select Status',
            'document_upload.required' => 'Upload a Document',
            'document_upload.mimes' => 'Document must be a PDF, PNG, or JPG file',
            'document_upload.max' => 'Document size must not exceed 2MB',
            'website_link.required' => 'Enter a Website Link',
            'website_link.url' => 'Enter a valid URL for Website Link',
        ];
    
        // Validate the request with rules and custom messages
        $validatedData = $request->validate($rules, $messages);
    
        // Save the vacancy with the validated data
        $vacancy = new ManageVacancy($validatedData);
    
        // Handle file upload if content_type is PDF
        if ($request->hasFile('document_upload')) {
            $vacancy->document_upload = $request->file('document_upload')->store('uploads', 'public');
        }
    
        // Save the vacancy in the database
        $vacancy->save();
    
        ManageAudit::create([
            'Module_Name' => 'Vacancy Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
    
        // Redirect with success message
        return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy created successfully');
    }
    


    public function edit($id)
	{
	    $vacancy = ManageVacancy::findOrFail($id); // Retrieves the vacancy by ID, or fails if not found
	    return view('admin.manage_vacancy.edit', compact('vacancy')); // Passes the $vacancy variable to the view
	}

    // public function update(Request $request, ManageVacancy $manage_vacancy)
    // {
    //     // Base validation rules
    //     $rules = [
    //         'language' => 'required',
    //         'job_title' => 'required|string|max:255',
    //         'job_description' => 'required',
    //         'content_type' => 'required|in:PDF,Website',
    //         'publish_date' => 'required|date',
    //         'expiry_date' => 'required|date|after_or_equal:publish_date',
    //         'status' => 'required|integer|in:1,2,3',
    //     ];

    //     // Conditionally add validation for either document_upload or website_link
    //     if ($request->content_type == 'PDF') {
    //         $rules['document_upload'] = 'nullable|mimes:pdf,png,jpg|max:2048'; // Allow null if no file change
    //     } elseif ($request->content_type == 'Website') {
    //         $rules['website_link'] = 'required_if:content_type,Website|url';
    //     }

    //     // Validate the request
    //     $validatedData = $request->validate($rules);

    //     // Handle file upload if content_type is PDF and a new file is uploaded
    //     if ($request->hasFile('document_upload')) {
    //         // Delete the old file if it exists
    //         if ($manage_vacancy->document_upload && file_exists(public_path('uploads/' . $manage_vacancy->document_upload))) {
    //             unlink(public_path('uploads/' . $manage_vacancy->document_upload));
    //         }

    //         // Store the new file
    //         $fileName = time() . '.' . $request->document_upload->getClientOriginalExtension();
    //         $request->document_upload->move(public_path('uploads'), $fileName);
    //         $validatedData['document_upload'] = $fileName;
    //     }

    //     // Update the vacancy with validated data
    //     $manage_vacancy->update($validatedData);

    //     // Add an audit log
    //     ManageAudit::create([
    //         'Module_Name' => 'Vacancy Module',
    //         'Time_Stamp' => time(), // Use Carbon to get the current timestamp
    //         'Created_By' => NULL, // ID of the authenticated user
    //         'Updated_By' => NULL, // ID of the authenticated user
    //         'Action_Type' => 'Update',
    //         'IP_Address' => $request->ip(),
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy updated successfully');
    // }

    public function update(Request $request, ManageVacancy $manage_vacancy)
    {
        // Validation rules
        $rules = [
            'language' => 'required',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,2,3',
        ];

        // Conditionally add validation for document_upload or website_link
        if ($request->content_type === 'PDF') {
            $rules['document_upload'] = 'nullable|mimes:pdf,jpg,png,jpeg|max:2048';
        } elseif ($request->content_type === 'Website') {
            $rules['website_link'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        // Handle file upload
        if ($request->hasFile('document_upload')) {
            if ($manage_vacancy->document_upload && Storage::exists('uploads/' . $manage_vacancy->document_upload)) {
                Storage::delete('uploads/' . $manage_vacancy->document_upload);
            }

            $validatedData['document_upload'] = $request->file('document_upload')->store('uploads', 'public');
        } else {
            $validatedData['document_upload'] = $manage_vacancy->document_upload;
        }

        $manage_vacancy->update($validatedData);

        ManageAudit::create([
            'Module_Name' => 'Vacancy Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy updated successfully');
    }



    public function destroy(ManageVacancy $manage_vacancy)
    {
        $manage_vacancy->delete();
        return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy deleted successfully');
    }
}
