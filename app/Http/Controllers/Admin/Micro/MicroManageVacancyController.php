<?php 
namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroManageVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;

class MicroManageVacancyController extends Controller
{
    public function index()
    {
        $vacancies = DB::table('micro_manage_vacancies as tp')
        ->leftJoin('research_centres as rc', 'tp.research_centre', '=', 'rc.id') // Adjust column names as needed
        ->select('tp.*', 'rc.research_centre_name as research_centre_name') // Include the name of the research centre
        ->get();

        return view('admin.micro.micro_manage_vacancy.index', compact('vacancies'));
    }

    public function create()
    {
        // Fetch research centres where status is 1 (Active)
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Only fetch active research centres
            ->pluck('research_centre_name', 'id'); // Replace with your actual column names

        // Pass the filtered list to the view
        return view('admin.micro.micro_manage_vacancy.create', compact('researchCentres'));
    }



    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'language' => 'required|integer|in:1,2',	
            'research_centre' => 'required|integer|exists:research_centres,id',	
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,0',
        ];

        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg,jpeg|max:2048';
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url';
        }

        // Custom messages
        $messages = [
            'language.required' => 'Please select a language.',
            'research_centre.required' => 'Please select a research centre.',
            'job_title.required' => 'Please enter a job title.',
            'job_title.max' => 'The job title cannot exceed 255 characters.',
            'job_description.required' => 'Please provide a job description.',
            'content_type.required' => 'Please select a content type.',
            'content_type.in' => 'Content type must be either PDF or Website.',
            'publish_date.required' => 'Please provide a publish date.',
            'publish_date.date' => 'Publish date must be a valid date.',
            'expiry_date.required' => 'Please provide an expiry date.',
            'expiry_date.date' => 'Expiry date must be a valid date.',
            'expiry_date.after_or_equal' => 'Expiry date must be on or after the publish date.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Status must be active or inactive.',
            'document_upload.required' => 'Please upload a document.',
            'document_upload.mimes' => 'The document must be a file of type: pdf, png, jpg, jpeg.',
            'document_upload.max' => 'The document size may not exceed 2MB.',
            'website_link.required' => 'Please provide a website link.',
            'website_link.url' => 'The website link must be a valid URL.',
        ];

        // Validate request
        $validatedData = $request->validate($rules, $messages);

        // Create and save the vacancy
        $vacancy = new MicroManageVacancy($validatedData);

        if ($request->hasFile('document_upload')) {
            $vacancy->document_upload = $request->file('document_upload')->store('uploads', 'public');
        }

        $vacancy->save();

        // Audit log
        MicroManageAudit::create([
            'Module_Name' => 'Vacancy Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('micro_manage_vacancy.index')->with('success', 'Vacancy created successfully');
    }


    public function edit($id)
    {
        // Fetch the specific training program by ID
        $vacancy = MicroManageVacancy::findOrFail($id); 

        // Fetch only active research centres (status == 1)
        $researchCentres = DB::table('research_centres')
            ->where('status', 1) // Include only active research centres
            ->pluck('research_centre_name', 'id') // Retrieves an associative array of id => name
            ->toArray();
        // dd($vacancy->research_centre);
        // dd($researchCentres);

        // Pass the variables to the Blade file
        return view('admin.micro.micro_manage_vacancy.edit', compact('vacancy', 'researchCentres'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'language' => 'required|integer|in:1,2',	
            'research_centre' => 'required|integer|exists:research_centres,id',	
            'job_title' => 'required|string|max:255',
            'job_description' => 'required',
            'content_type' => 'required|in:PDF,Website',
            'publish_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:publish_date',
            'status' => 'required|integer|in:1,0',
        ];

        if ($request->content_type == 'PDF') {
            $rules['document_upload'] = 'required|mimes:pdf,png,jpg,jpeg|max:2048';
        } elseif ($request->content_type == 'Website') {
            $rules['website_link'] = 'required|url';
        }

        // Custom messages
        $messages = [
            'language.required' => 'Please select a language.',
            'research_centre.required' => 'Please select a research centre.',
            'job_title.required' => 'Please enter a job title.',
            'job_title.max' => 'The job title cannot exceed 255 characters.',
            'job_description.required' => 'Please provide a job description.',
            'content_type.required' => 'Please select a content type.',
            'content_type.in' => 'Content type must be either PDF or Website.',
            'publish_date.required' => 'Please provide a publish date.',
            'publish_date.date' => 'Publish date must be a valid date.',
            'expiry_date.required' => 'Please provide an expiry date.',
            'expiry_date.date' => 'Expiry date must be a valid date.',
            'expiry_date.after_or_equal' => 'Expiry date must be on or after the publish date.',
            'status.required' => 'Please select a status.',
            'status.in' => 'Status must be active or inactive.',
            'document_upload.required' => 'Please upload a document.',
            'document_upload.mimes' => 'The document must be a file of type: pdf, png, jpg, jpeg.',
            'document_upload.max' => 'The document size may not exceed 2MB.',
            'website_link.required' => 'Please provide a website link.',
            'website_link.url' => 'The website link must be a valid URL.',
        ];
        // Fetch the record by ID
        $vacancy = MicroManageVacancy::findOrFail($id);

        // Get request data (no validation)
        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('document_upload')) {
            // Remove old file
            if ($vacancy->document_upload && \Storage::exists($vacancy->document_upload)) {
                \Storage::delete($vacancy->document_upload);
            }

            // Save new file
            $filePath = $request->file('document_upload')->store('uploads', 'public');
            $data['document_upload'] = $filePath;
        }

        // Update record
        $vacancy->update($data);

        // Redirect back
        return redirect()->route('micro_manage_vacancy.index')->with('success', 'Vacancy updated successfully.');
    } 

    public function destroy($id)
    {
        // Find the record
        $media = MicroManageVacancy::findOrFail($id);

        // Check if the status is 1 (Active/Inactive based on your logic)
        if ($media->status == 1) {
            return redirect()->route('micro_manage_vacancy.index')->with('error', 'Active vacancies cannot be deleted.');
        }

        // Proceed with deletion if the condition is not met
        $media->delete();

        return redirect()->route('micro_manage_vacancy.index')->with('success', 'Vacancy deleted successfully.');
    }

}