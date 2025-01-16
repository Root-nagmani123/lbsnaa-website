<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admin\ManageAudit;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('is_deleted', 0)->get();
        $menuTree = $this->buildMenuTree($menus);

        return view('admin.menus.index', compact('menuTree'));
    }

    private function buildMenuTree($menus, $parentId = null)
    {
        $branch = [];

        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->buildMenuTree($menus, $menu->id);
                if ($children) {
                    $menu->children = $children;
                }
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
        $menuOptions = $this->buildMenuOptions();

        return view('admin.menus.create', compact('menuOptions'));
    }

    private function buildMenuOptions($parentId = null, $spacing = '')
    {
        $parentId = $parentId ?? 0;
        $menus = Menu::where('parent_id', $parentId)
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

    public function store(Request $request)
    {

         // Validation rules
        $request->validate([
            'txtlanguage' => 'required|in:1,2',
            'menutitle' => 'required|string|max:255',
            'texttype' => 'required|integer|in:1,2,3', // Example values for texttype
            // 'menucategory' => 'required|integer|min:1',
            'txtpostion' => 'nullable|integer',
            'start_date' => 'nullable|date',
            'termination_date' => 'nullable|date|after_or_equal:start_date',
            'menu_status' => 'nullable|boolean',
            'website_url' => 'nullable', // Only if texttype is 3
        ],
        [
            'txtlanguage.required' => 'Please select a language.',
            'txtlanguage.in' => 'Invalid language selection.',
            'menutitle.required' => 'Please enter the menu title.',
            'menutitle.string' => 'The menu title must be a string.',
            'menutitle.max' => 'The menu title must not exceed 255 characters.',
            'texttype.required' => 'Please select a text type.',
            'texttype.integer' => 'The text type must be a valid integer.',
            'texttype.in' => 'Invalid text type selection.',
            
            'txtpostion.integer' => 'Please select any content Position.',
            'meta_title.max' => 'The meta title must not exceed 255 characters.',
            'meta_keyword.max' => 'The meta keyword must not exceed 255 characters.',
            'meta_description.max' => 'The meta description must not exceed 500 characters.',
            'web_site_target.url' => 'Please enter a valid website URL.',
            'start_date.date' => 'The start date must be a valid date.',
            'termination_date.date' => 'The termination date must be a valid date.',
            'termination_date.after_or_equal' => 'The termination date must be after or equal to the start date.',
            'menu_status.boolean' => 'Please select any status.',
            'pdf_file.file' => 'The uploaded file must be a valid file.',
            'pdf_file.mimes' => 'The uploaded file must be a PDF.',
            'pdf_file.max' => 'The uploaded file size must not exceed 2MB.',
            'content.string' => 'The content must be a valid string.',
            'website_url.url' => 'The website URL must be valid.',
        ]);
        $slug = Str::slug($request->menutitle, '-');

        // Check if slug already exists
        $existingMenu = Menu::where('menu_slug', $slug)->first();
        if ($existingMenu) {
            return redirect()->back()->withErrors(['menutitle' => 'This menu title already exists.'])->withInput();
        } 

        $menu = new Menu();
        $menu->language = $request->txtlanguage;
        $menu->menutitle = $request->menutitle;
        if($request->txtlanguage == '1'){
            $menu->menu_slug = Str::slug($request->menutitle, '-');
        }elseif($request->txtlanguage == '2'){
            $menu->menu_slug = Str::slug($request->meta_title, '-') . '_hi';

        }
        
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

        $menu->save();

        ManageAudit::create([
            'Module_Name' => 'Menu Module',
            'Time_Stamp' => time(),
            'Created_By' => null,
            'Updated_By' => null,
            'Action_Type' => 'Insert',
            'IP_Address' => $request->ip(),
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::find($id);
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
                $options .= $this->getMenuOptions($menus, $selectedCategoryId, $m->id, $indent . '--- ');
            }
        }
        return $options;
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->language = $request->txtlanguage;
        $menu->menutitle = $request->menutitle;
        if($request->txtlanguage == '1'){
            $menu->menu_slug = Str::slug($request->menutitle, '-');
        }elseif($request->txtlanguage == '2'){
            $menu->menu_slug = Str::slug($request->meta_title, '-') . '_hi';

        }
        // $menu->menu_slug = Str::slug($request->menutitle, '-');
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
        $menu->web_site_target = $request->input('web_site_target');

        if ($request->hasFile('pdf_file')) {
            if (File::exists(public_path($menu->pdf_file))) {
                File::delete(public_path($menu->pdf_file));
            }

            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs/'), $fileName);
            $menu->pdf_file = 'pdfs/' . $fileName;
        }

        $menu->save();

        // ManageAudit::create([
        //     'Module_Name' => 'Menu Module',
        //     'Time_Stamp' => now(),
        //     'Created_By' => null,
        //     'Updated_By' => null,
        //     'Action_Type' => 'Update',
        //     'IP_Address' => $request->ip(),
        // ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }
 
    public function delete($id)
    {
        // Find the menu by its ID or fail if it doesn't exist
        $menu = Menu::findOrFail($id);

        // Check if the menu status is inactive (status = 1) and prevent deletion
        if ($menu->menu_status == 1) {
            return redirect()->route('admin.menus.index')->with('error', 'Active menus cannot be deleted.');
        }

        // Mark the menu as deleted (soft delete)
        $menu->is_deleted = 1;
        $menu->save();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }


    public function toggleStatus(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->menu_status = !$menu->menu_status;
        $menu->save();

        return response()->json(['status' => $menu->menu_status]);
    }
    
    public function toggle_status(Request $request)
    {
        $id = $request->id;
        $table = $request->table;
        $column = $request->column;
        $status = $request->status;

        try {
            // Validate inputs
        

            // Update the status dynamically
            DB::table($table)
                ->where('id', $id)
                ->update([$column => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function check_menu_title(Request $request)
{
    $title = $request->input('title');
    $exists = DB::table('menus')->where('menu_slug', $title)->exists();

    return response()->json(['exists' => $exists]);
}
    public function feedback_list()
    {
        // Fetch feedback data
        $feedbacks = DB::table('feedback')->orderBy('created_at', 'desc')->get();

        // Define category mapping
        $categories = [
            1 => 'Signup/Login',
            2 => 'Task',
            3 => 'Discussion',
            4 => 'LBSNAA Content',
            5 => 'Others'
        ];

        // Pass data and categories to the view
        return view('admin.feedback_list', compact('feedbacks', 'categories'));
    }

}
