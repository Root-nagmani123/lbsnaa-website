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
            'category_name_hindi' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Use Query Builder to insert a new category
        $souvenir = DB::table('souvenircategory')->insert([
            'type' => $request->input('type'),
            'category_name' => $request->input('category_name'),
            'category_name_hindi' => $request->input('category_name_hindi'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        ManageAudit::create([
            'Module_Name' => 'Souvenir Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($souvenir), // Save state as JSON
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

    // Remove the specified category from the database
    public function destroy($id)
    {
        // Use Query Builder to delete the category by ID
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

    // Store a new Academy Souvenir
    public function storeAcademySouvenir(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'product_category' => 'required|integer',
            'product_title' => 'required|string|max:255',
            'product_type' => 'required|in:Sale,Download',
            'product_price' => 'nullable|numeric|required_if:product_type,Sale',
            'product_discounted_price' => 'nullable|numeric',
            'contact_email_id' => 'nullable|email|required_if:product_type,Sale',
            'document_upload' => 'nullable|file|required_if:product_type,Download',
            'upload_image' => 'required|file|image',
            'product_description' => 'nullable|string',
            'product_status' => 'required|boolean',
        ]);

        // Handle file uploads
        // $document_upload = $request->file('document_upload') ? $request->file('document_upload')->store('documents') : null;
        // $upload_image = $request->file('upload_image')->store('images');
        $document_name = '';
        if ($request->hasFile('document_upload')) {
            $document_upload = $request->file('document_upload');
            $document_name = $document_upload->getClientOriginalName();
            $documentPath = $document_upload->move(public_path('AcademySouvenir/documents'), $document_upload->getClientOriginalName());
        }

        if ($request->hasFile('upload_image')) {
            $upload_image = $request->file('upload_image');
            $upload_name = $upload_image->getClientOriginalName();
            $imagePath = $upload_image->move(public_path('AcademySouvenir/images'), $upload_image->getClientOriginalName());
        }

        // Insert Academy Souvenir using Query Builder
        $AcademySouvenir = DB::table('academy_souvenirs')->insert([
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

        ManageAudit::create([
            'Module_Name' => 'Academy Souvenir Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
            'Current_State' => json_encode($AcademySouvenir), // Save state as JSON
        ]);

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
    public function updateAcademySouvenir(Request $request, $id)
{
    $request->validate([
        'language' => 'required',
        'product_category' => 'required|integer',
        'product_title' => 'required|string|max:255',
        'product_type' => 'required|in:Sale,Download',
        'product_price' => 'nullable|numeric|required_if:product_type,Sale',
        'product_discounted_price' => 'nullable|numeric',
        'contact_email_id' => 'nullable|email|required_if:product_type,Sale',
        'document_upload' => 'nullable|file|required_if:product_type,Download',
        'upload_image' => 'nullable|file|image',
        'product_description' => 'nullable|string',
        'product_status' => 'required|boolean',
    ]);

    // Handle file uploads
    $document_upload = $request->input('old_document_upload'); // default to old document if no new file
    if ($request->hasFile('document_upload')) {
        // Move the new document to the public/assets/documents folder
        $document_upload_file = $request->file('document_upload');
        $document_name = time() . '_' . $document_upload_file->getClientOriginalName();
        $document_upload_file->move(public_path('AcademySouvenir/documents'), $document_name);
        $document_upload = $document_name; // set new document name to save in the DB

        // Optionally: delete the old document if it exists
        if ($request->input('old_document_upload')) {
            $oldDocumentPath = public_path('AcademySouvenir/documents/' . $request->input('old_document_upload'));
            if (file_exists($oldDocumentPath)) {
                unlink($oldDocumentPath);
            }
        }
    }

    $upload_image = $request->input('old_upload_image'); // default to old image if no new file
    if ($request->hasFile('upload_image')) {
        // Move the new image to the public/assets/images folder
        $image_upload_file = $request->file('upload_image');
        $image_name = time() . '_' . $image_upload_file->getClientOriginalName();
        $image_upload_file->move(public_path('AcademySouvenir/images'), $image_name);
        $upload_image = $image_name; // set new image name to save in the DB

        // Optionally: delete the old image if it exists
        if ($request->input('old_upload_image')) {
            $oldImagePath = public_path('AcademySouvenir/images/' . $request->input('old_upload_image'));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    }

    // Update Academy Souvenir using Query Builder
    $AcademySouvenir = DB::table('academy_souvenirs')->where('id', $id)->update([
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

    ManageAudit::create([
        'Module_Name' => 'Academy Souvenir Module', // Static value
        'Time_Stamp' => time(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Insert', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
        'Current_State' => json_encode($AcademySouvenir), // Save state as JSON
    ]);

    return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir updated successfully.');
}


    // Delete an Academy Souvenir
    public function destroyAcademySouvenir($id)
    {
        DB::table('academy_souvenirs')->where('id', $id)->delete();
        return redirect()->route('academy_souvenirs.index')->with('success', 'Academy Souvenir deleted successfully.');
    }
}
