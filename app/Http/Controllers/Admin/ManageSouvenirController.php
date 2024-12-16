<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'type' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'category_name_hindi' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

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
        $request->validate([
            'type' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'category_name_hindi' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

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

        return redirect()->route('souvenir.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        // Retrieve the category by ID to check its status
        $category = DB::table('souvenircategory')->where('id', $id)->first();
        // Check if the category exists
        if (!$category) {
            return redirect()->route('souvenir.index')->with('error', 'Category not found.');
        }
        // Check if the status is inactive (1)
        if ($category->status == 1) {
            return redirect()->route('souvenir.index')->with('error', 'Inactive categories cannot be deleted.');
        }
        // Proceed to delete the category
        DB::table('souvenircategory')->where('id', $id)->delete();
        return redirect()->route('souvenir.index')->with('success', 'Category deleted successfully.');
    }


    public function indexAcademySouvenirs()
    {
        // Fetch all academy souvenirs
        $souvenirs = DB::table('academy_souvenirs')->get();
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

    // // Store a new Academy Souvenir
    // public function storeAcademySouvenir(Request $request)
    // {
    //     $document_name = '';
    //     if ($request->hasFile('document_upload')) {
    //         $document_upload = $request->file('document_upload');
    //         $document_name = $document_upload->getClientOriginalName();
    //         $documentPath = $document_upload->move(public_path('AcademySouvenir/documents'), $document_upload->getClientOriginalName());
    //     }

    //     if ($request->hasFile('upload_image')) {
    //         $upload_image = $request->file('upload_image');
    //         $upload_name = $upload_image->getClientOriginalName();
    //         $imagePath = $upload_image->move(public_path('AcademySouvenir/images'), $upload_image->getClientOriginalName());
    //     }

    //     // Insert Academy Souvenir using Query Builder
    //     $AcademySouvenir = DB::table('academy_souvenirs')->insert([
    //         'language' => $request->input('language'),
    //         'product_category' => $request->input('product_category'),
    //         'product_title' => $request->input('product_title'),
    //         'product_type' => $request->input('product_type'),
    //         'product_price' => $request->input('product_price'),
    //         'product_discounted_price' => $request->input('product_discounted_price'),
    //         'contact_email_id' => $request->input('contact_email_id'),
    //         'document_upload' => $document_name,
    //         'upload_image' => $upload_name,
    //         'product_description' => $request->input('product_description'),
    //         'product_status' => $request->input('product_status'),
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);

    //     ManageAudit::create([
    //         'Module_Name' => 'Academy Souvenir Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir created successfully.');
    // }

    public function storeAcademySouvenir(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'language' => 'required|in:1,2',
            'product_category' => 'required|string|max:255',
            'product_title' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            // 'product_price' => 'required|numeric|min:0',
            // 'product_discounted_price' => 'nullable|numeric|min:0|lte:product_price',
            // 'contact_email_id' => 'required|email|max:255',
            'document_upload' => 'nullable|file|mimes:pdf,doc,docx|max:20480', // 20 MB limit
            'upload_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240', // 10 MB limit
            'product_status' => 'required|in:0,1', // Assuming 'active' and 'inactive' are valid statuses
        ]);

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

        // Add audit log entry
        // ManageAudit::create([
        //     'Module_Name' => 'Academy Souvenir Module',
        //     'Time_Stamp' => time(),
        //     'Created_By' => null, // Assuming you want to log the user ID
        //     'Updated_By' => null,
        //     'Action_Type' => 'Insert',
        //     'IP_Address' => $request->ip(),
        // ]);

        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir created successfully.');
    }


    // Show form for editing a specific Academy Souvenir
    public function editAcademySouvenir($id)
    {
        $souvenir = DB::table('academy_souvenirs')->where('id', $id)->first();
        $categories = DB::table('souvenircategory')->select('category_name', 'id')->get();
        return view('admin.souvenirModule.academy_souvenirs.edit', compact('souvenir', 'categories'));
    }

    // Update Academy Souvenir
    // public function updateAcademySouvenir(Request $request, $id)
    // {
    //     // Handle file uploads
    //     $document_upload = $request->input('old_document_upload'); // default to old document if no new file
    //     if ($request->hasFile('document_upload')) {
    //         // Move the new document to the public/assets/documents folder
    //         $document_upload_file = $request->file('document_upload');
    //         $document_name = time() . '_' . $document_upload_file->getClientOriginalName();
    //         $document_upload_file->move(public_path('AcademySouvenir/documents'), $document_name);
    //         $document_upload = $document_name; // set new document name to save in the DB

    //         // Optionally: delete the old document if it exists
    //         if ($request->input('old_document_upload')) {
    //             $oldDocumentPath = public_path('AcademySouvenir/documents/' . $request->input('old_document_upload'));
    //             if (file_exists($oldDocumentPath)) {
    //                 unlink($oldDocumentPath);
    //             }
    //         }
    //     }

    //     $upload_image = $request->input('old_upload_image'); // default to old image if no new file
    //     if ($request->hasFile('upload_image')) {
    //         // Move the new image to the public/assets/images folder
    //         $image_upload_file = $request->file('upload_image');
    //         $image_name = time() . '_' . $image_upload_file->getClientOriginalName();
    //         $image_upload_file->move(public_path('AcademySouvenir/images'), $image_name);
    //         $upload_image = $image_name; // set new image name to save in the DB

    //         // Optionally: delete the old image if it exists
    //         if ($request->input('old_upload_image')) {
    //             $oldImagePath = public_path('AcademySouvenir/images/' . $request->input('old_upload_image'));
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }
    //     }

    //     // Update Academy Souvenir using Query Builder
    //     $AcademySouvenir = DB::table('academy_souvenirs')->where('id', $id)->update([
    //         'language' => $request->input('language'),
    //         'product_category' => $request->input('product_category'),
    //         'product_title' => $request->input('product_title'),
    //         'product_type' => $request->input('product_type'),
    //         'product_price' => $request->input('product_price'),
    //         'product_discounted_price' => $request->input('product_discounted_price'),
    //         'contact_email_id' => $request->input('contact_email_id'),
    //         'document_upload' => $document_upload,
    //         'upload_image' => $upload_image,
    //         'product_description' => $request->input('product_description'),
    //         'product_status' => $request->input('product_status'),
    //         'updated_at' => now()
    //     ]);

    //     ManageAudit::create([
    //         'Module_Name' => 'Academy Souvenir Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir updated successfully.');
    // }

    // Update Academy Souvenir
    public function updateAcademySouvenir(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'language' => 'required|string',
            'product_category' => 'required|string',
            'product_title' => 'required|string|max:255',
            'product_type' => 'required|string',
            // 'product_price' => 'required|numeric|min:0',
            // 'product_discounted_price' => 'nullable|numeric|min:0',
            // 'contact_email_id' => 'required|email',
            // 'document_upload' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Example validation
            // 'upload_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Example validation
            // 'product_description' => 'nullable|string',
            // 'product_status' => 'required|in:0,1',
        ]);
        dd($request);
        // Handle document file upload
        $document_upload = $request->input('old_document_upload'); // Default to old document
        if ($request->hasFile('document_upload')) {
            $document_file = $request->file('document_upload');
            $document_name = time() . '_' . $document_file->getClientOriginalName();
            $document_file->move(public_path('AcademySouvenir/documents'), $document_name);
            $document_upload = $document_name;

            // Delete old document if it exists
            if ($request->input('old_document_upload')) {
                $oldDocumentPath = public_path('AcademySouvenir/documents/' . $request->input('old_document_upload'));
                if (file_exists($oldDocumentPath)) {
                    unlink($oldDocumentPath);
                }
            }
        }

        // Handle image file upload
        $upload_image = $request->input('old_upload_image'); // Default to old image
        if ($request->hasFile('upload_image')) {
            $image_file = $request->file('upload_image');
            $image_name = time() . '_' . $image_file->getClientOriginalName();
            $image_file->move(public_path('AcademySouvenir/images'), $image_name);
            $upload_image = $image_name;

            // Delete old image if it exists
            if ($request->input('old_upload_image')) {
                $oldImagePath = public_path('AcademySouvenir/images/' . $request->input('old_upload_image'));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        // dd($updateResult);
        // Perform update operation
        $updateResult = DB::table('academy_souvenirs')->where('id', $id)->update([
            'language' => $request->input('language'),
            'product_category' => $request->input('product_category'),
            'product_title' => $request->input('product_title'),
            'product_type' => $request->input('product_type'),
            'product_price' => $request->input('product_price'),
            'product_discounted_price' => $request->input('product_discounted_price'),
            'contact_email_id' => $request->input('contact_email_id'),
            'document_upload' => $document_upload,
            'upload_image' => $upload_image,
            'product_description' => $request->input('product_description'),
            'product_status' => $request->input('product_status'),
            'updated_at' => now()
        ]);

        // Log the update in the audit table
        ManageAudit::create([
            'Module_Name' => 'Academy Souvenir Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // ID of the authenticated user
            'Action_Type' => 'Update', // Corrected action type
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        // Redirect based on update result
        if ($updateResult) {
            return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update Academy Souvenir. Please try again.');
        }
    }



    // Delete an Academy Souvenir
    public function destroyAcademySouvenir($id)
    {
        DB::table('academy_souvenirs')->where('id', $id)->delete();
        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir deleted successfully.');
    }
}