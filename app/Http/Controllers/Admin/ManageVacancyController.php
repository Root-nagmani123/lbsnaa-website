<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
        // ✅ Base validation rules
        $rules = [
            'language' => 'required',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,0',
        ];
    
        // ✅ Conditionally add validation for file or URL
        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg|max:2048'; 
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url';
        }
    
        // ✅ Custom Messages (Optional)
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
    
        // ✅ Perform Validation
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
    
        // ✅ Get Validated Data
        $validatedData = $validator->validated();
    
        // ✅ Save the vacancy with validated data
        $vacancy = new ManageVacancy($validatedData);
    
        // ✅ Handle file upload if content_type is PDF
        if ($request->hasFile('document_upload')) {
            $vacancy->document_upload = $request->file('document_upload')->store('uploads', 'public');
        }
    
        // ✅ Save vacancy in database
        $vacancy->save();
    
        // ✅ Save Audit Log
        ManageAudit::create([
            'Module_Name' => 'Vacancy Module',
            'Time_Stamp' =>  time(), 
            'Created_By' => auth()->id(), 
            'Updated_By' => null, 
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);
        Cache::put('success_message', 'Vacancy created successfully!', 1);
    
        // ✅ Redirect with success message
        return redirect()->route('manage_vacancy.index');
    }
    


    public function edit($id)
	{
	    $vacancy = ManageVacancy::findOrFail($id); // Retrieves the vacancy by ID, or fails if not found
	    return view('admin.manage_vacancy.edit', compact('vacancy')); // Passes the $vacancy variable to the view
	}



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
            'status' => 'required|integer|in:1,0',
        ];
    
        // ✅ Conditionally add validation for file or URL
        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg|max:2048'; 
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url';
        }
    
        // ✅ Custom Messages (Optional)
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
    
        // ✅ Perform Validation
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            // ❇ Cache validation errors for 1 minute
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        $validatedData = $request->validate($rules, $messages);
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
        Cache::put('success_message', 'Vacancy updated  successfully!', 1);

        return redirect()->route('manage_vacancy.index');
    }



    // public function destroy(ManageVacancy $manage_vacancy)
    // {
    //     $manage_vacancy->delete();
    //     return redirect()->route('manage_vacancy.index')->with('success', 'Vacancy deleted successfully');
    // }

    public function destroy(ManageVacancy $manage_vacancy)
    {
        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($manage_vacancy->status == 1) {
        Cache::put('error_message', 'Active vacancies cannot be deleted!', 1);

            return redirect()->route('manage_vacancy.index');
        }

        // Proceed with deletion if status is not 1
        $manage_vacancy->delete();
        Cache::put('success_message', 'Vacancy deleted successfully!', 1);

        return redirect()->route('manage_vacancy.index');
    }

}
