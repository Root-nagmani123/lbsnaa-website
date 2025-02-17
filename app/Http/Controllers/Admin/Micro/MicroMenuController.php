<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\MicroMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\Micro\MicroManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MicroMenuController extends Controller
{ 
    // public function index() 
    // {

    //     $menus = DB::table('micromenus')
    //     ->leftJoin('research_centres', 'micromenus.research_centreid', '=', 'research_centres.id')
    //     ->select('micromenus.*', 'research_centres.research_centre_name as rec_name') 
    //     ->where('micromenus.is_deleted', 0)
    //     ->get()
    //     ->toArray();
    
    //     echo '<pre>';
    //     print_r($menus);
    //     echo '</pre>';


    //     $menus = micromenu::where('is_deleted', 0)->get();
    //     echo '<pre>';
    //     print_r($menus);die();
    //     echo '</pre>';


    //     $menuTree = $this->buildMenuTree($menus);
    //     // dd($menuTree);
    //     return view('admin.micro.manage_micromenus.index', compact('menuTree'));
    // }

    public function index() 
{
    // Fetch data with raw join, still working with objects
    $menus = DB::table('micromenus')
        ->leftJoin('research_centres', 'micromenus.research_centreid', '=', 'research_centres.id')
        ->select(
            'micromenus.id',
            'micromenus.menutitle', 
            'micromenus.research_centreid',
            'research_centres.research_centre_name', 
            'micromenus.texttype', 
            'micromenus.txtpostion', 

            'micromenus.menu_status', 
            'micromenus.created_at', 
            'micromenus.updated_at',
            'micromenus.parent_id'
        )
        ->where('micromenus.is_deleted', 0)
        ->get(); 

    // Convert the result into an array (optional step)
    $menus = $menus->toArray(); // If you need to convert to array

    // Now, proceed with the rest of the processing as usual
    $menuTree = $this->buildMenuTree($menus);

    return view('admin.micro.manage_micromenus.index', compact('menuTree'));
}





//     public function index()
// {
//     $menus = DB::table('micromenus')
//         ->leftJoin('research_centres', 'micromenus.research_centreid', '=', 'research_centres.id')
//         ->select('micromenus.*', 'research_centres.research_centre_name as rec_name') // Select desired columns
//         ->where('micromenus.is_deleted', 0)
//         ->get();

//     $menuTree = $this->buildMenuTree($menus);

//     return view('admin.micro.manage_micromenus.index', compact('menuTree'));
// }


    // private function buildMenuTree($menus, $parentId = null)
    // {
    //     $branch = [];
    //     // dd($menus);
    //     foreach ($menus as $menu) {
    //         // dd($parentId);
    //     // dd($menu->parent_id);
    //         if ($menu->parent_id == $parentId) {
    //             $children = $this->buildMenuTree($menus, $menu->id);
    //             // dd($children);
    //             if ($children) {
    //                 $menu->children = $children;
    //             }
    //             $branch[] = $menu;
    //         }
    //     }

    //     return $branch;
    // }

    private function buildMenuTree($menus, $parentId = null)
{
    $branch = [];

    // Loop through each menu item
    foreach ($menus as $menu) {
        // Check if the current menu's parent_id matches the parentId passed to the function
        if ($menu->parent_id == $parentId) {  // Use object access here
            // Recursively build tree for children
            $children = $this->buildMenuTree($menus, $menu->id);  // Access 'id' in object format

            // If children exist, add them to the current menu item
            if ($children) {
                // Ensure the children property exists
                $menu->children = $children;
            }

            // Add the current menu item to the branch
            $branch[] = $menu;
        }
    }

    return $branch;
}



    


    protected function getMenuType($type)
    {
        switch ($type) {
            case 1:
                return 'Content';
            case 2:
                return 'PDF File Upload';
            case 3:
                return 'Website URL';
            default:
                return 'Unknown';
        }
    }

    protected function getContentPosition($position)
    {
        switch ($position) {
            case 1:
                return 'Header Menu';
            case 2:
                return 'Bottom Menu';
            case 3:
                return 'Footer Menu';
            case 4:
                return 'Director Message Menu';
            case 5:
                return 'Life Academy Menu';
            case 6:
                return 'Other Pages';
            case 7:
                return 'Latest Updates';
            default:
                return 'Unknown';
        }
    }

    public function create()
    {
        // Filter research centres where state equals 1
        $researchCentres = DB::table('research_centres')
                            ->where('status', 1)
                            ->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.


        $menuOptions = $this->buildMenuOptions();

        // Return view with filtered research centres and menu options
        return view('admin.micro.manage_micromenus.create', compact('menuOptions', 'researchCentres'));
    } 


    private function buildMenuOptions($parentId = null, $spacing = '')
    {
        $parentId = $parentId ?? 0;
        $menus = MicroMenu::where('parent_id', $parentId)
            ->whereIn('txtpostion', [1, 2])
            ->where('is_deleted', 0)
            ->get();
        $options = '';

        foreach ($menus as $menu) {
            $options .= '<option value="' . $menu->id . '">' . $spacing . $menu->menutitle . '</option>';
            $options .= $this->buildMenuOptions($menu->id, $spacing . '--- ');
        }

        return $options;
    }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'language' => 'required',
    //         'research_centre' => 'required',
    //         'menutitle' => 'required|string|max:255',
    //         'texttype' => 'required',
    //         'menucategory' => 'required',
    //         'txtpostion' => 'required',            
    //         'menu_status' => 'required|in:1,0',
            
    //     ]);

    //     // Create new menu entry
    //     $menu = new micromenu();
    //     $menu->language = $request->language;
    //     $menu->research_centreid = $request->research_centre;
    //     $menu->menutitle = $request->menutitle;
    //     $menu->menu_slug = Str::slug($request->menutitle, '-'); 
    //     $menu->texttype = $request->texttype;
    //     $menu->menucategory = $request->menucategory;
    //     $menu->parent_id = $request->menucategory;
    //     $menu->txtpostion = $request->txtpostion;
    //     $menu->meta_title = $request->input('meta_title');
    //     $menu->meta_keyword = $request->input('meta_keyword');
    //     $menu->meta_description = $request->input('meta_description');
    //     $menu->web_site_target = $request->input('web_site_target'); // Store web_site_target as integer
    //     $menu->menu_status = $request->menu_status;

    //     // Handle file upload
    //     if ($request->hasFile('pdf_file')) {
    //         $file = $request->file('pdf_file');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $destinationPath = public_path('pdfs');
    //         $file->move($destinationPath, $filename);
    //         $menu->pdf_file = 'pdfs/' . $filename;
    //     }

    //     // Handle content based on texttype
    //     if ($request->texttype == 1) {
    //         $menu->content = $request->content;
    //     } elseif ($request->texttype == 3) {
    //         $menu->website_url = $request->website_url;
    //     }
 
    //     // Save the menu to the database
    //     $menu->save();

    //     // Audit logging
    //     MicroManageAudit::create([
    //         'Module_Name' => 'Menu',
    //         'Time_Stamp' => time(),
    //         'Created_By' => null,
    //         'Updated_By' => null,
    //         'Action_Type' => 'Insert',
    //         'IP_Address' => $request->ip(),
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('micromenus.index')->with('success', 'Menu created successfully.');
    // }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'language' => 'required',
            'research_centre' => 'required',
            'menutitle' => 'required|string|max:255',
            'texttype' => 'required',
            'menucategory' => 'required',
            'txtpostion' => 'required',
            'menu_status' => 'required|in:1,0',
        ], [
            'texttype.required' => 'Please select menu type.',
            'txtpostion.required' => 'Please select content position.',
            'menutitle.required' => 'Please enter menu title.',
        ]);
        // dd($request);
        // Check if the combination of menutitle and research_centre already exists
        $existingMenu = MicroMenu::where('research_centreid', $request->research_centre)
            ->where('menutitle', $request->menutitle)
            ->first(); 

        if ($existingMenu) {
            return redirect()->back()->withErrors([
                'menutitle' => 'The menu title for the selected research centre already exists.'
            ])->withInput();
        }

        // Create new menu entry
        $menu = new MicroMenu();
        $menu->language = $request->language;
        $menu->research_centreid = $request->research_centre;
        $menu->menutitle = $request->menutitle;
        $menu->menu_slug = Str::slug($request->menutitle, '-');
        $menu->texttype = $request->texttype;
        $menu->menucategory = $request->menucategory;
        $menu->parent_id = $request->menucategory;
        $menu->txtpostion = $request->txtpostion;
        $menu->meta_title = $request->input('meta_title');
        $menu->meta_keyword = $request->input('meta_keyword');
        $menu->meta_description = $request->input('meta_description');
        $menu->web_site_target = $request->input('web_site_target');

        // Handle file upload
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('pdfs');
            $file->move($destinationPath, $filename);
            $menu->pdf_file = 'pdfs/' . $filename;
        }

        // Handle content based on texttype
        if ($request->texttype == 1) {
            $menu->content = $request->content;
        } elseif ($request->texttype == 3) {
            $menu->website_url = $request->website_url;
        }

        // Save the menu to the database
        $menu->menu_status = $request->menu_status;
        $menu->save();

        // Audit logging
        MicroManageAudit::create([
            'Module_Name' => 'Menu',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        // Redirect with success message
        return redirect()->route('micromenus.index')->with('success', 'Menu created successfully.');
    }



    public function edit($id)
    {
        // Fetch the menu details using Query Builder
        $menu = DB::table('micromenus')->where('id', $id)->first();

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        // Fetch all menus related to the same research centre
        $menus = DB::table('micromenus')
            ->where('research_centreid', $menu->research_centreid) // Filter menus by research_centre_id
            ->get();

        // Build the menu options for the dropdown
        $menuOptions = $this->buildMenuOptionsss($menus, $menu->menucategory);

        // Fetch all research centres
        $researchCentres = DB::table('research_centres')
            ->select('id', 'research_centre_name')
            ->pluck('research_centre_name', 'id')
            ->toArray();

        return view('admin.micro.manage_micromenus.edit', compact('menu', 'menuOptions', 'researchCentres'));
    }

    // Function to build menu options hierarchically
    private function buildMenuOptionsss($menus, $selectedCategory = null, $parentId = 0, $level = 0)
    {
        $html = '';

        foreach ($menus->where('parent_id', $parentId) as $menu) {
            $indent = str_repeat('&nbsp;', $level * 4); // Add indentation for hierarchy
            $isSelected = $menu->id == $selectedCategory ? 'selected' : ''; // Mark selected option
            $html .= "<option value=\"{$menu->id}\" {$isSelected}>{$indent}{$menu->menutitle}</option>";

            // Recursively add child menus
            $html .= $this->buildMenuOptionsss($menus, $selectedCategory, $menu->id, $level + 1);
        }

        return $html;
    }



    private function getMenuOptions($menus, $selectedCategoryId, $parentId = 0, $indent = '')
    {
        $options = '';
        foreach ($menus as $m) {
            if ($m->parent_id == $parentId) {
                $selected = ($selectedCategoryId == $m->id) ? 'selected' : '';
                $options .= '<option value="' . $m->id . '" ' . $selected . '>' . htmlspecialchars($indent . $m->menutitle) . '</option>';
                $options .= $this->getMenuOptions($menus, $selectedCategoryId, $m->id, $indent . '--- ');
            }
        }
        return $options;
    }

    // public function update(Request $request, $id)
    // {
    //     $menu = micromenu::findOrFail($id);
    //     $menu->language = $request->txtlanguage;
    //     $menu->research_centreid = $request->research_centre;
    //     $menu->menutitle = $request->menutitle;
    //     $menu->menu_slug = Str::slug($request->menutitle, '-');
    //     $menu->texttype = $request->texttype;
    //     $menu->menucategory = $request->menucategory;
    //     $menu->parent_id = $request->menucategory;
    //     $menu->txtpostion = $request->txtpostion;
    //     $menu->meta_title = $request->input('meta_title');
    //     $menu->meta_keyword = $request->input('meta_keyword');
    //     $menu->meta_description = $request->input('meta_description');
    //     $menu->content = $request->input('content', null);
    //     $menu->website_url = $request->input('website_url', null);
    //     $menu->menu_status = $request->input('menu_status', 0);
    //     $menu->start_date = $request->input('start_date');
    //     $menu->termination_date = $request->input('termination_date');

    //     if ($request->hasFile('pdf_file')) {
    //         if (File::exists(public_path($menu->pdf_file))) {
    //             File::delete(public_path($menu->pdf_file));
    //         }

    //         $file = $request->file('pdf_file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads/menus/'), $fileName);
    //         $menu->pdf_file = 'uploads/menus/' . $fileName;
    //     }

    //     $menu->save();

    //     MicroManageAudit::create([
    //         'Module_Name' => 'Menu', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Update', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     return redirect()->route('micromenus.index')->with('success', 'Menu updated successfully.');
    // }

    // public function update(Request $request, $id)
    // {
    //     // Find the existing menu
    //     $menu = micromenu::findOrFail($id);

    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'txtlanguage' => 'required',
    //         'research_centre' => 'required',
    //         'menutitle' => 'required|string|max:255',
    //         'texttype' => 'required',
    //         'menucategory' => 'required',
    //         'txtpostion' => 'required',
    //         'menu_status' => 'required|in:1,0',
    //     ]);

    //     // Check for duplicate combination of research_centre and menutitle, excluding the current menu
    //     $existingMenu = micromenu::where('research_centreid', $request->research_centre)
    //         ->where('menutitle', $request->menutitle)
    //         ->where('id', '!=', $id)
    //         ->first();

    //     if ($existingMenu) {
    //         return redirect()->back()->withErrors([
    //             'menutitle' => 'The menu title for the selected research centre already exists.'
    //         ])->withInput();
    //     }

    //     // Update the menu fields
    //     $menu->language = $request->txtlanguage;
    //     $menu->research_centreid = $request->research_centre;
    //     $menu->menutitle = $request->menutitle;
    //     $menu->menu_slug = Str::slug($request->menutitle, '-');
    //     $menu->texttype = $request->texttype;
    //     $menu->menucategory = $request->menucategory;
    //     $menu->parent_id = $request->menucategory;
    //     $menu->txtpostion = $request->txtpostion;
    //     $menu->meta_title = $request->input('meta_title');
    //     $menu->meta_keyword = $request->input('meta_keyword');
    //     $menu->meta_description = $request->input('meta_description');
    //     $menu->content = $request->input('content', null);
    //     $menu->website_url = $request->input('website_url', null);
    //     $menu->menu_status = $request->input('menu_status', 0);
    //     $menu->start_date = $request->input('start_date');
    //     $menu->termination_date = $request->input('termination_date');

    //     // Handle file upload
    //     if ($request->hasFile('pdf_file')) {
    //         if (File::exists(public_path($menu->pdf_file))) {
    //             File::delete(public_path($menu->pdf_file));
    //         }

    //         $file = $request->file('pdf_file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads/menus/'), $fileName);
    //         $menu->pdf_file = 'uploads/menus/' . $fileName;
    //     } 

    //     // Save the updated menu
    //     $menu->save();

    //     // Audit logging
    //     MicroManageAudit::create([
    //         'Module_Name' => 'Menu',
    //         'Time_Stamp' => time(),
    //         'Created_By' => null,
    //         'Updated_By' => null,
    //         'Action_Type' => 'Update',
    //         'IP_Address' => $request->ip(),
    //     ]);

    //     // Redirect with success message
    //     return redirect()->route('micromenus.index')->with('success', 'Menu updated successfully.');
    // }

    public function update(Request $request, $id)
    {
        // Find the existing menu
        $menu = MicroMenu::findOrFail($id);
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'txtlanguage' => 'required',
            'research_centre' => 'required',
            'menutitle' => 'required|string|max:255',
            'texttype' => 'required',
            'menucategory' => 'required',
            'txtpostion' => 'required',
            'menu_status' => 'required|in:1,0',
        ]);
    
        // Check for duplicate combination of research_centre and menutitle, excluding the current menu
        $existingMenu = MicroMenu::where('research_centreid', $request->research_centre)
            ->where('menutitle', $request->menutitle)
            ->where('id', '!=', $id)
            ->first();
    
        if ($existingMenu) {
            return redirect()->back()->withErrors([
                'menutitle' => 'The menu title for the selected research centre already exists.'
            ])->withInput();
        }
    
        // Handle different texttype values
        if ($request->texttype == 1) { // Content
            $menu->content = $request->input('content', null);
            $menu->website_url = null;
            $menu->pdf_file = null;
        } elseif ($request->texttype == 2) { // PDF file Upload
            $menu->content = null;
            $menu->website_url = null;
            
            // Handle file upload
            if ($request->hasFile('pdf_file')) {
                if (File::exists(public_path($menu->pdf_file))) {
                    File::delete(public_path($menu->pdf_file));
                }
    
                $file = $request->file('pdf_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/menus/'), $fileName);
                $menu->pdf_file = 'uploads/menus/' . $fileName;
            }
        } elseif ($request->texttype == 3) { // Website Url
            $menu->content = null;
            $menu->pdf_file = null;
            $menu->website_url = $request->input('website_url', null);
        }
    
        // Update other fields
        $menu->language = $request->txtlanguage;
        $menu->research_centreid = $request->research_centre;
        $menu->menutitle = $request->menutitle;
        $menu->menu_slug = Str::slug($request->menutitle, '-');
        $menu->menucategory = $request->menucategory;
        $menu->parent_id = $request->menucategory;
        $menu->txtpostion = $request->txtpostion;
        $menu->meta_title = $request->input('meta_title');
        $menu->meta_keyword = $request->input('meta_keyword');
        $menu->meta_description = $request->input('meta_description');
        $menu->menu_status = $request->input('menu_status', 0);
        $menu->start_date = $request->input('start_date');
        $menu->termination_date = $request->input('termination_date');
    
        // Save the updated menu
        $menu->save();
    
        // Audit logging
        MicroManageAudit::create([
            'Module_Name' => 'Menu',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);
    
        // Redirect with success message
        return redirect()->route('micromenus.index')->with('success', 'Menu updated successfully.');
    }
    


    public function delete($id)
    {
        $menu = MicroMenu::findOrFail($id);

        if ($menu->menu_status == 1) {
            return redirect()->route('micromenus.index')->with('error', 'Active menus cannot be deleted.');
        }

        // Mark the menu as deleted
        $menu->is_deleted = 1;
        $saved = $menu->save();

        if ($saved) {
            return redirect()->route('micromenus.index')->with('success', 'Menu marked as deleted successfully.');
        } else {
            return redirect()->route('micromenus.index')->with('error', 'Failed to delete the menu.');
        }
    }
  


    public function toggleStatus(Request $request, $id)
    {
        
        $menu = MicroMenu::findOrFail($id);
        $menu->menu_status = !$menu->menu_status;
        $menu->save();

        return response()->json(['status' => $menu->menu_status]);
    }
    

    public function getDropdownMenu(Request $request)
    {
        try {
            // Log the input to debug
            \Log::info('Request Data:', $request->all());

            $researchCentreId = $request->input('research_centre_id');
            if (!$researchCentreId) {
                return response()->json(['error' => 'Research Centre ID is missing'], 400);
            }

            // Log the research centre ID
            \Log::info('Research Centre ID:', ['id' => $researchCentreId]);

            // Query the database
            $categories = DB::table('micromenus')
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->where('research_centreid', $researchCentreId)
                ->get();
            // Log the query result
            \Log::info('Categories:', $categories->toArray());

            if ($categories->isEmpty()) {
                return response()->json(['error' => 'No categories found for the selected research centre.'], 404);
            }

            $menuOptions = $this->buildMenuOptionss($categories);

            // Log the menu options
            \Log::info('Menu Options:', ['options' => $menuOptions]);

            return response()->json(['menuOptions' => $menuOptions]);

        } catch (\Exception $e) {
            // Log the exception details
            \Log::error('Error in getDropdownMenu:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }


    private function buildMenuOptionss($categories, $parentId = 0, $level = 0)
    {
        $html = '';
        foreach ($categories->where('parent_id', $parentId) as $category) {
            $indent = str_repeat('&nbsp;', $level * 4);
            $html .= "<option value=\"{$category->id}\">{$indent}{$category->menutitle}</option>";
            $html .= $this->buildMenuOptionss($categories, $category->id, $level + 1);
        }
        return $html;
    }







}
