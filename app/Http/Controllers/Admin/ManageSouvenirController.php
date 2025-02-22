<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ManageSouvenirController extends Controller
{
    public function index()
    {
        // Use Query Builder to get all categories
        $categories = DB::table('souvenircategory')->get();
        return view('admin.souvenirModule.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('admin.souvenirModule.create');
    }

    // Store a newly created category in the database

    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'category_name_hindi' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    
        // **Custom Error Messages**
        $messages = [
            'type.required' => 'Type field is required.',
            'category_name.required' => 'Category Name is required.',
            'category_name_hindi.required' => 'Category Name in Hindi is required.',
            'status.required' => 'Status is required.',
        ];
    
        // **Run Validator**
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }

        // Insert into the souvenir category table
        $souvenir = DB::table('souvenircategory')->insert([
            'type' => $request->input('type'),
            'category_name' => $request->input('category_name'),
            'category_name_hindi' => $request->input('category_name_hindi'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Log the action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Souvenir Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // Authenticated user ID
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Category created successfully!', 1);

        return redirect()->route('souvenir.index')->with('success', 'Category created successfully.');
    }


    // Show the form for editing the specified category
    public function edit($id)
    {
        // Use Query Builder to get a single category by ID
        $category = DB::table('souvenircategory')->where('id', $id)->first();

        return view('admin.souvenirModule.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        $rules = [
            'type' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'category_name_hindi' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    
        // **Custom Error Messages**
        $messages = [
            'type.required' => 'Type field is required.',
            'category_name.required' => 'Category Name is required.',
            'category_name_hindi.required' => 'Category Name in Hindi is required.',
            'status.required' => 'Status is required.',
        ];
    
        // **Run Validator**
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with errors and old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }

        // Use Query Builder to update the category
        $souvenir = DB::table('souvenircategory')
            ->where('id', $id)
            ->update([
                'type' => $request->input('type'),
                'category_name' => $request->input('category_name'),
                'category_name_hindi' => $request->input('category_name_hindi'),
                'status' => $request->input('status'),
                'updated_at' => now()
            ]);

            ManageAudit::create([
                'Module_Name' => 'Souvenir Module', // Static value
                'Time_Stamp' => time(), // Current timestamp
                'Created_By' => null, // ID of the authenticated user
                'Updated_By' => null, // No update on creation, so leave null
                'Action_Type' => 'Update', // Static value
                'IP_Address' => $request->ip(), // Get IP address from request
                'Current_State' => json_encode($souvenir), // Save state as JSON
            ]);
            Cache::put('success_message', 'Category updated successfully!', 1);

        return redirect()->route('souvenir.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        // Retrieve the category by ID to check its status
        $category = DB::table('souvenircategory')->where('id', $id)->first();
        // Check if the category exists
        if (!$category) {
            Cache::put('error_message', 'Category not found!', 1);

            return redirect()->route('souvenir.index')->with('error', 'Category not found.');
        }
        // Check if the status is inactive (1)
        if ($category->status == 1) {
            Cache::put('error_message', 'Active categories cannot be deleted!', 1);

            return redirect()->route('souvenir.index')->with('error', 'Active categories cannot be deleted.');
        }
        // Proceed to delete the category
        DB::table('souvenircategory')->where('id', $id)->delete();
        Cache::put('success_message', 'Category deleted successfully!', 1);

        return redirect()->route('souvenir.index')->with('success', 'Category deleted successfully.');
    }


    public function indexAcademySouvenirs()
    {
        // Fetch all academy souvenirs
        $souvenirs = DB::table('academy_souvenirs')
        ->leftJoin('souvenircategory as parent', 'academy_souvenirs.product_category', '=', 'parent.id')
        
        ->select('academy_souvenirs.*', 'parent.category_name')
        ->get();
        return view('admin.souvenirModule.academy_souvenirs.index', compact('souvenirs'));
    }

    // Show form to create a new Academy Souvenir
    public function createAcademySouvenir()
    {
        // Fetch product categories for the select box
        $categories = DB::table('souvenircategory')->select('category_name', 'id')->get();
        // print_r($categories);die;
        return view('admin.souvenirModule.academy_souvenirs.create', compact('categories'));
    }

    public function storeAcademySouvenir(Request $request)
    {
        // Validate the input fields
        $rules = [
            'language' => 'required|in:1,2',
            'product_category' => 'required|string|max:255',
            'product_title' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            // 'product_price' => 'required|numeric|min:0',
            // 'product_discounted_price' => 'nullable|numeric|min:0|lte:product_price',
            // 'contact_email_id' => 'required|email|max:255',
            'document_upload' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:20480', // 20 MB limit
            'upload_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240', // 10 MB limit
            'product_status' => 'required|in:0,1', // Assuming 'active' and 'inactive' are valid statuses
        ];
    
        // **Custom Error Messages**
        $messages = [
            'language.required' => 'Language selection is required.',
            'language.in' => 'Invalid language selection.',
            'product_category.required' => 'Product category is required.',
            'product_title.required' => 'Product title is required.',
            'product_type.required' => 'Product type is required.',
            'upload_image.required' => 'Product image is required.',
            'upload_image.image' => 'The uploaded file must be an image.',
            'upload_image.mimes' => 'Only JPG, JPEG, PNG, and GIF images are allowed.',
            'upload_image.max' => 'The image must not be larger than 10MB.',
            'document_upload.mimes' => 'Only JPG, JPEG, PNG, GIF, PDF, DOC, and DOCX files are allowed.',
            'document_upload.max' => 'The document must not be larger than 20MB.',
            'product_status.required' => 'Product status is required.',
            'product_status.in' => 'Invalid product status.',
        ];
    
        // **Run Validator**
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // **If Validation Fails**
        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
            return redirect(session('url.previousdata', url('/')))->withInput(); 
        }   
        try {
        $document_name = '';
        $upload_name = '';

        // Handle document upload
        if ($request->hasFile('document_upload')) {
            $document_upload = $request->file('document_upload');
            $document_name = $document_upload->getClientOriginalName();
            $documentPath = $document_upload->move(public_path('AcademySouvenir/documents'), $document_name);
        }

        // Handle image upload
        if ($request->hasFile('upload_image')) {
            $upload_image = $request->file('upload_image');
            $upload_name = $upload_image->getClientOriginalName();
            $imagePath = $upload_image->move(public_path('AcademySouvenir/images'), $upload_name);
        }

        // Insert Academy Souvenir using Query Builder
        DB::table('academy_souvenirs')->insert([
            'language' => $request->input('language'),
            'product_category' => $request->input('product_category'),
            'product_title' => $request->input('product_title'),
            'product_type' => $request->input('product_type'),
            'product_price' => $request->input('product_price'),
            'product_discounted_price' => $request->input('product_discounted_price'),
            'contact_email_id' => $request->input('contact_email_id'),
            'document_upload' => $document_name,
            'upload_image' => $upload_name,
            'product_description' => $request->input('product_description'),
            'product_status' => $request->input('product_status'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Cache::put('success_message', 'Academy Souvenir created successfully!', 1);

        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir created successfully.');
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error storing Academy Souvenir: ' . $e->getMessage());
        Cache::put('error_message', 'Something went wrong. Please try again!', 1);
        // Redirect back with an error message
        // return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        return redirect(session('url.previousdata', url('/')))->withInput();    
    }
    }


    // Show form for editing a specific Academy Souvenir
    public function editAcademySouvenir($id)
    {
        $souvenir = DB::table('academy_souvenirs')->where('id', $id)->first();
        $categories = DB::table('souvenircategory')->select('category_name', 'id')->get();
        return view('admin.souvenirModule.academy_souvenirs.edit', compact('souvenir', 'categories'));
    }

    // Update Academy Souvenir

    public function updateAcademySouvenir(Request $request, $id)
    {
        // Fetch current records to ensure we don't overwrite missing fields
        $currentSouvenir = DB::table('academy_souvenirs')->where('id', $id)->first();

        // Handle document file upload
        $document_upload = $request->input('document_upload', $currentSouvenir->document_upload); // Use old document if no new file
        if ($request->hasFile('document_upload')) {
            // Move the new document to the public/assets/documents folder
            $document_upload_file = $request->file('document_upload');
            $document_name = time() . '_' . $document_upload_file->getClientOriginalName();
            $document_upload_file->move(public_path('AcademySouvenir/documents'), $document_name);
            $document_upload = $document_name; // Set new document name to save in the DB

            // Optionally: delete the old document if it exists
            if ($currentSouvenir->document_upload) {
                $oldDocumentPath = public_path('AcademySouvenir/documents/' . $currentSouvenir->document_upload);
                if (file_exists($oldDocumentPath)) {
                    unlink($oldDocumentPath);
                }
            }
        }

        // Handle image file upload
        $upload_image = $request->input('upload_image', $currentSouvenir->upload_image); // Use old image if no new file
        if ($request->hasFile('upload_image')) {
            // Move the new image to the public/assets/images folder
            $image_upload_file = $request->file('upload_image');
            $image_name = time() . '_' . $image_upload_file->getClientOriginalName();
            $image_upload_file->move(public_path('AcademySouvenir/images'), $image_name);
            $upload_image = $image_name; // Set new image name to save in the DB

            // Optionally: delete the old image if it exists
            if ($currentSouvenir->upload_image) {
                $oldImagePath = public_path('AcademySouvenir/images/' . $currentSouvenir->upload_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        // Update Academy Souvenir using Query Builder
        DB::table('academy_souvenirs')->where('id', $id)->update([
            'language' => $request->input('language'),
            'product_category' => $request->input('product_category'),
            'product_title' => $request->input('product_title'),
            'product_type' => $request->input('product_type'),
            'product_price' => $request->input('product_price'),
            'product_discounted_price' => $request->input('product_discounted_price'),
            'contact_email_id' => $request->input('contact_email_id'),
            'document_upload' => $document_upload, // Keep old document if no new file uploaded
            'upload_image' => $upload_image, // Keep old image if no new file uploaded
            'product_description' => $request->input('product_description'),
            'product_status' => $request->input('product_status'),
            'updated_at' => now()
        ]);

        // Log the update in the audit table
        ManageAudit::create([
            'Module_Name' => 'Academy Souvenir Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
        Cache::put('success_message', 'Academy Souvenir updated successfully!', 1);

        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir updated successfully.');
    }

    // Delete an Academy Souvenir
    public function destroyAcademySouvenir($id)
    {
        // Fetch the souvenir record
        $souvenir = DB::table('academy_souvenirs')->where('id', $id)->first();

        // Check if the status is 1 (Inactive), and if so, prevent deletion
        if ($souvenir->product_status == 1) {
        Cache::put('error_message', 'Active academy souvenirs cannot be deleted!', 1);
            
            return redirect()->route('academy_souvenirs.index')->with('error', 'Active academy souvenirs cannot be deleted.');
        }

        // Proceed with deletion if the status is not 1
        DB::table('academy_souvenirs')->where('id', $id)->delete();
        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir deleted successfully.');
    }

}