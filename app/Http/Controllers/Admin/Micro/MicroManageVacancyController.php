<?php 
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroManageVacancy;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class MicroManageVacancyController extends Controller
{
    public function index()
    {
        $vacancies = MicroManageVacancy::all();
        return view('admin.micro.manage_vacancy.index', compact('vacancies'));
    }

    public function create()
    {
        return view('admin.micro.manage_vacancy.create');
    }


    // public function store(Request $request)
    // {
    //     // Base validation rules
    //     $rules = [
    //         'language' => 'required|integer|in:1,2',
    //         'job_title' => 'required|string|max:255',
    //         'job_description' => 'required',
    //         'content_type' => 'required|in:PDF,Website',
    //         'publish_date' => 'required|date',
    //         'expiry_date' => 'required|date|after_or_equal:publish_date',
    //         'status' => 'required|integer|in:1,2,3',
    //     ];

    //     // Conditionally add validation for either document_upload or website_link
    //     if ($request->content_type == 'PDF') {
    //         $rules['document_upload'] = 'required|mimes:pdf,png,jpg|max:2048'; // Required if PDF is selected
    //     } elseif ($request->content_type == 'Website') {
    //         $rules['website_link'] = 'required|url'; // Required if Website is selected
    //     }

    //     // Validate the request with the updated rules
    //     $validatedData = $request->validate($rules);

    //     // Save the vacancy with the validated data
    //     $vacancy = new MicroManageVacancy($validatedData);

    //     // Handle file upload if content_type is PDF
    //     if ($request->hasFile('document_upload')) {
    //         $vacancy->document_upload = $request->file('document_upload')->store('uploads', 'public');
    //     }

    //     // Save the vacancy in the database
    //     $vacancy->save();

    //     ManageAudit::create([
    //         'Module_Name' => 'Vacancy Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //         'Current_State' => json_encode($vacancy), // Save state as JSON
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy created successfully');
    // }

    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'language' => 'required|integer|in:1,2',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,2,3',
        ];

        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg,jpeg|max:2048';
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        $vacancy = new MicroManageVacancy($validatedData);

        if ($request->hasFile('document_upload')) {
            $vacancy->document_upload = $request->file('document_upload')->store('uploads', 'public');
        }

        $vacancy->save();

        ManageAudit::create([
            'Module_Name' => 'Vacancy Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
            'Current_State' => json_encode($vacancy),
        ]);

        return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy created successfully');
    }



    public function edit($id)
	{
	    $vacancy = MicroManageVacancy::findOrFail($id); // Retrieves the vacancy by ID, or fails if not found
	    return view('admin.micro.manage_vacancy.edit', compact('vacancy')); // Passes the $vacancy variable to the view
	}

    // public function update(Request $request, MicroManageVacancy $manage_vacancy)
    // {
    //     // Base validation rules
    //     $rules = [
    //         'language' => 'required|integer|in:1,2',
    //         'job_title' => 'required|string|max:255',
    //         'job_description' => 'required',
    //         'content_type' => 'required|in:PDF,Website',
    //         'publish_date' => 'required|date',
    //         'expiry_date' => 'required|date|after_or_equal:publish_date',
    //         'status' => 'required|integer|in:1,2,3',
    //     ];

    //     // Conditionally add validation for either document_upload or website_link
    //     if ($request->content_type == 'PDF') {
    //         $rules['document_upload'] = 'sometimes|mimes:pdf,png,jpg|max:2048'; // Only required if PDF is selected, and update allows no file change
    //     } elseif ($request->content_type == 'Website') {
    //         $rules['website_link'] = 'required_if:content_type,Website|url'; // Only required if Website is selected
    //     }

    //     // Validate the request with the updated rules
    //     $validatedData = $request->validate($rules);

    //     // Handle file upload if content_type is PDF and a new file is uploaded
    //     if ($request->hasFile('document_upload')) {
    //         $fileName = time() . '.' . $request->document_upload->extension();
    //         $request->document_upload->move(public_path('uploads'), $fileName);
    //         $validatedData['document_upload'] = $fileName;
    //     }

    //     // Update the vacancy with the validated data
    //     $manage_vacancy->update($validatedData);

    //     ManageAudit::create([
    //         'Module_Name' => 'Vacancy Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //         'Current_State' => json_encode($manage_vacancy), // Save state as JSON
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy updated successfully');
    // }

    public function update(Request $request, MicroManageVacancy $manage_vacancy)
{
    // Base validation rules
    $rules = [
        'language' => 'required|integer|in:1,2',
        'job_title' => 'required|string|max:255',
        'job_description' => 'required',
        'content_type' => 'required|in:PDF,Website',
        'publish_date' => 'required|date',
        'expiry_date' => 'required|date|after_or_equal:publish_date',
        'status' => 'required|integer|in:1,2,3',
    ];

    // Conditionally add validation for either document_upload or website_link
    if ($request->content_type == 'PDF') {
        $rules['document_upload'] = 'sometimes|mimes:pdf,png,jpg|max:2048'; // Allow PDF and image file types
    } elseif ($request->content_type == 'Website') {
        $rules['website_link'] = 'required_if:content_type,Website|url'; // Only required if Website is selected
    }

    // Validate the request with the updated rules
    $validatedData = $request->validate($rules);

    // Check if a file has been uploaded and handle it
    if ($request->hasFile('document_upload')) {
        // Delete the old document if it exists
        if ($manage_vacancy->document_upload && \Storage::exists('public/' . $manage_vacancy->document_upload)) {
            \Storage::delete('public/' . $manage_vacancy->document_upload); // Delete old file
        }

        // Store the new document and update the path
        $fileName = time() . '.' . $request->document_upload->extension(); // Generate new file name
        $request->document_upload->storeAs('uploads', $fileName, 'public'); // Save the file

        $validatedData['document_upload'] = 'uploads/' . $fileName; // Store the relative path
    }

    // Update the vacancy with the validated data
    $manage_vacancy->update($validatedData);

    // Create a new audit entry
    ManageAudit::create([
        'Module_Name' => 'Vacancy Module',
        'Time_Stamp' => time(),
        'Created_By' => null, // Adjust this with the authenticated user's ID if needed
        'Updated_By' => null, 
        'Action_Type' => 'Update',
        'IP_Address' => $request->ip(),
        'Current_State' => json_encode($manage_vacancy),
    ]);

    // Redirect with success message
    return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy updated successfully');
}



    public function destroy(MicroManageVacancy $manage_vacancy)
    {
        $manage_vacancy->delete();
        return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy deleted successfully');
    }
}
