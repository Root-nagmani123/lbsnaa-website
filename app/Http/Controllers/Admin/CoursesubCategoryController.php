<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesubCategoryController extends Controller
{
    public function index()
    {
        // Retrieve subcategories with their parent category names
        $subcategories = DB::table('courses_sub_categories as sub')
            ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
            ->select('sub.*', 'parent.category_name as parent_category_name')
            ->get();

        $categoryTree = $this->buildCategoryTree($subcategories);


        return view('admin.manage_coursesubcategories.index', compact('subcategories', 'categoryTree'));
    }

    // Helper function to build the menu tree structure

    private function buildCategoryTree($categories, $parentId = 0, $prefix = '')
    {
        $result = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $category->category_name = $prefix . $category->category_name;
                $result[] = $category;
                $children = $this->buildCategoryTree($categories, $category->id, $prefix . '-');
                $result = array_merge($result, $children);
            }
        }
        return $result;
    }


    public function create()
    {
        $subcategories = DB::table('courses_sub_categories as sub')
        ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
        ->select('sub.*', 'parent.category_name as parent_category_name')
        ->get();

    $categoryTree = $this->buildCategoryTree($subcategories);
            return view('admin.manage_coursesubcategories.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'category_name' => 'required',
            'color_theme' => 'nullable|string',
            'parent_id' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'required|in:1,2,3',
        ]);

        DB::table('courses_sub_categories')->insert([
            'language' => $request->input('language'),
            'category_name' => $request->input('category_name'),
            'color_theme' => $request->input('color_theme'),
            'parent_id' => !empty($request->input('parent_id')) ? $request->input('parent_id') : 0,
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('subcategory.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        // Fetch the subcategory to edit
        $subcategory = DB::table('courses_sub_categories')->where('id', $id)->first();
        // Fetch all categories for the dropdown
        $categories = DB::table('courses_sub_categories as sub')
        ->leftJoin('courses_sub_categories as parent', 'sub.parent_id', '=', 'parent.id')
        ->select('sub.*', 'parent.category_name as parent_category_name')
        ->get();

        return view('admin.manage_coursesubcategories.edit', compact('subcategory', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'language' => 'required',
            'category_name' => 'required',
            'color_theme' => 'nullable|string',
            'parent_id' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'required|in:1,2,3',
        ]);

        DB::table('courses_sub_categories')
            ->where('id', $id)
            ->update([
                'language' => $request->input('language'),
                'category_name' => $request->input('category_name'),
                'color_theme' => $request->input('color_theme'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);

        return redirect()->route('subcategory.index')->with('success', 'Menu updated successfully.');
    }


    public function delete($id)
    {
        DB::table('courses_sub_categories')->where('id', $id)->delete();
        return redirect()->route('subcategory.index')->with('success', 'Category deleted successfully');
    }
}
