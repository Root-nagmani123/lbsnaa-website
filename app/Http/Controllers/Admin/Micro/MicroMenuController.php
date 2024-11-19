<?php

namespace App\Http\Controllers\Admin\Micro;

use App\Http\Controllers\Controller;
use App\Models\Admin\Micro\micromenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\DB;

class MicroMenuController extends Controller
{
    public function index()
    {
        $menus = micromenu::where('is_deleted', 0)->get();
        $menuTree = $this->buildMenuTree($menus);

        return view('admin.micro.manage_micromenus.index', compact('menuTree'));
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
        $researchCentres = DB::table('research_centres')->pluck('research_centre_name', 'id'); // Replace 'name' and 'id' with your actual column names.
        $menuOptions = $this->buildMenuOptions();

        return view('admin.micro.manage_micromenus.create', compact('menuOptions','researchCentres'));
    }

    private function buildMenuOptions($parentId = null, $spacing = '')
    {
        $parentId = $parentId ?? 0;
        $menus = micromenu::where('parent_id', $parentId)
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
        $menu = new micromenu();
        $menu->language = $request->txtlanguage;
        $menu->research_centreid = $request->research_centre;
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

        $menu->save();
       
        return redirect()->route('micromenus.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = micromenu::find($id);
        $menus = micromenu::all();
        $menuOptions = $this->getMenuOptions($menus, $menu->menucategory);
        $researchCentres = DB::table('research_centres')
        ->select('id', 'research_centre_name')
        ->pluck('research_centre_name', 'id')
        ->toArray();

        return view('admin.micro.manage_micromenus.edit', compact('menu', 'menuOptions','researchCentres'));
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
        $menu = micromenu::findOrFail($id);
        $menu->language = $request->txtlanguage;
        $menu->research_centreid = $request->research_centre;
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

        if ($request->hasFile('pdf_file')) {
            if (File::exists(public_path($menu->pdf_file))) {
                File::delete(public_path($menu->pdf_file));
            }

            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menus/'), $fileName);
            $menu->pdf_file = 'uploads/menus/' . $fileName;
        }

        $menu->save();
        return redirect()->route('micromenus.index')->with('success', 'Menu updated successfully.');
    }

    public function delete($id)
    {
        $menu = micromenu::findOrFail($id);

        $menu->is_deleted = 1;
        $menu->save();

        return redirect()->route('micromenus.index')->with('success', 'Menu marked as deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        
        $menu = micromenu::findOrFail($id);
        $menu->menu_status = !$menu->menu_status;
        $menu->save();

        return response()->json(['status' => $menu->menu_status]);
    }
}
