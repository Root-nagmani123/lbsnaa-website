<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('is_deleted', 0)->get(); // Retrieve all menus
        $menuTree = $this->buildMenuTree($menus); // Build the menu tree structure

        return view('admin.menus.index', compact('menuTree')); // Pass the tree to the view
    }


    // Build a tree structure for menus
    private function buildMenuTree($menus, $parentId = null)
    {
        $branch = [];

        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->buildMenuTree($menus, $menu->id);
                if ($children) {
                    $menu->children = $children; // Assign children to the current menu
                }
                $branch[] = $menu; // Add the menu to the branch
            }
        }
        return $branch; // Return the branch
    }

    // Add these two helper methods in the controller
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
        // Get menu options
        $menuOptions = $this->buildMenuOptions();

        return view('admin.menus.create', compact('menuOptions'));
    }

    private function buildMenuOptions($parentId = null, $spacing = '')
    {
        $parentId = $parentId ?? 0;
        // Use null instead of 0 to also retrieve menus without a parent
        $menus = Menu::where('parent_id', $parentId)
            ->whereIn('txtpostion', [1, 2])
            ->where('is_deleted', 0)
            ->get();
        $options = '';

        foreach ($menus as $menu) {
            // Add option for current menu
            $options .= '<option value="' . $menu->id . '">' . $spacing . $menu->menutitle . '</option>';

            // Recursively get child menus
            $options .= $this->buildMenuOptions($menu->id, $spacing . '--- ');
        }

        return $options;
    }
    // Store the newly created menu
    public function store(Request $request)
    {
        // print_r($_POST);die;
        $menu = new Menu();
        $menu->menutitle = $request->menutitle;
        $menu->texttype = $request->texttype;
        $menu->menucategory = $request->menucategory;
        $menu->parent_id = $request->menucategory;
        $menu->txtpostion = $request->txtpostion;
        $menu->meta_title = $request->input('meta_title');
        $menu->meta_keyword = $request->input('meta_keyword');
        $menu->meta_description = $request->input('meta_description');
        $menu->web_site_target = $request->input('web_site_target');
        $menu->start_date = $request->input('start_date');
        $menu->termination_date = $request->input('termination_date');
        $menu->menu_status = $request->input('menu_status', 0);
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('pdfs');
            $file->move($destinationPath, $filename);
            $menu->pdf_file = 'pdfs/' . $filename;
        }
        if ($request->texttype == 1) {
            $menu->content = $request->content;
        } elseif ($request->texttype == 3) {
            $menu->website_url = $request->website_url;
        }
        $menu = $menu->save();

        ManageAudit::create([
            'Module_Name' => 'Menu Module', // Static value
            'Time_Stamp' => now(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    // A helper method to build menu options for the dropdown

    public function edit($id)
    {
        $menu = Menu::find($id); // Assuming you have the menu ID from the request or route
        $menus = Menu::all();
        $menuOptions = $this->getMenuOptions($menus, $menu->menucategory);

        return view('admin.menus.edit', compact('menu', 'menuOptions'));
    }
    private function getMenuOptions($menus, $selectedCategoryId, $parentId = 0, $indent = '')
    {
        $options = '';
        foreach ($menus as $m) {
            if ($m->parent_id == $parentId) {
                $selected = ($selectedCategoryId == $m->id) ? 'selected' : '';
                $options .= '<option value="' . $m->id . '" ' . $selected . '>' . htmlspecialchars($indent . $m->menutitle) . '</option>';

                // Recursively get child menus
                $options .= $this->getMenuOptions($menus, $selectedCategoryId, $m->id, $indent . '--- ');
            }
        }
        return $options;
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id); // Find the menu item by ID

        // Update the fields
        $menu->menutitle = $request->menutitle;
        $menu->texttype = $request->texttype;
        $menu->menucategory = $request->menucategory;
        $menu->parent_id = $request->menucategory;
        $menu->txtpostion = $request->txtpostion;
        $menu->meta_title = $request->input('meta_title');
        $menu->meta_keyword = $request->input('meta_keyword');
        $menu->meta_description = $request->input('meta_description');
        $menu->content = $request->input('content', null);
        $menu->website_url = $request->input('website_url', null);
        $menu->menu_status = $request->input('menu_status', 0);
        $menu->start_date = $request->input('start_date');
        $menu->termination_date = $request->input('termination_date');

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            // Delete the old file if it exists
            if (File::exists(public_path($menu->pdf_file))) {
                File::delete(public_path($menu->pdf_file));
            }

            // Store the new file
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menus/'), $fileName);
            $menu->pdf_file = 'uploads/menus/' . $fileName;
        }
        // print_r($_POST);
        // die;
        $menu->menu_slug = Str::slug($request->menutitle, '-');

        $menu = $menu->save(); // Save the menu


        // ManageAudit::create([
        //     'Module_Name' => 'Menu Module', // Static value
        //     'Time_Stamp' => now(), // Current timestamp
        //     'Created_By' => null, // ID of the authenticated user
        //     'Updated_By' => null, // No update on creation, so leave null
        //     'Action_Type' => 'Update', // Static value
        //     'IP_Address' => $request->ip(), // Get IP address from request
        //     'Current_State' => json_encode($menu), // Save state as JSON
        // ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully');
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);

        // Update the is_delete column to 1 (or true)
        $menu->is_deleted = 1;
        $menu->save();

        // Redirect with a success message
        return redirect()->route('admin.menus.index')->with('success', 'Menu marked as deleted successfully.');
    }
    public function toggleStatus(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        // Toggle the status: 1 -> 0 or 0 -> 1
        $menu->menu_status = !$menu->status;
        $menu->save();

        // Return the new status to the AJAX response
        return response()->json(['status' => $menu->status]);
    }
}
