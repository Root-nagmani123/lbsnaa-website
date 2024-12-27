<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        // Validate the input data
        $validatedData = $request->validate([
            'language' => 'required', // Ensure 'language' exists in the 'languages' table
            'category_name' => 'required|string|max:255', // Category name should be a string and have a max length
            'color_theme' => 'nullable|string|max:50', // Color theme is optional but should be a string with max length
            'parent_id' => 'nullable|exists:courses_sub_categories,id', // Ensure parent_id exists in the same table
            'description' => 'required|string|max:500', // Description is optional but should be a string with max length
            'status' => 'required|in:0,1', // Status should be either 0 or 1
        ]);

        // Insert the validated data into the database
        DB::table('courses_sub_categories')->insert([
            'language' => $validatedData['language'],
            'category_name' => $validatedData['category_name'],
            'color_theme' => $validatedData['color_theme'] ?? '', // Default to empty string if color_theme is not provided
            'parent_id' => $validatedData['parent_id'] ?? 0, // Default to 0 if parent_id is not provided
            'description' => $validatedData['description'] ?? '', // Default to empty string if description is not provided
            'status' => $validatedData['status'],
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => Str::slug($validatedData['category_name'], '-'), // Generate a slug based on category_name
        ]);

        // Redirect to the subcategory index page with a success message
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
            'status' => 'required|in:0,1',
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
                'slug' => Str::slug($request->category_name, '-'), 
            ]);

        return redirect()->route('subcategory.index')->with('success', 'Menu updated successfully.');
    }

    public function delete($id)
    {
        // Retrieve the record first
        $subcategory = DB::table('courses_sub_categories')->where('id', $id)->first();

        // Check if the record exists
        if (!$subcategory) {
            return redirect()->route('subcategory.index')->with('error', 'Subcategory not found.');
        }

        // Check if the status is 1 (Inactive), and prevent deletion if true
        if ($subcategory->status == 1) {
            return redirect()->route('subcategory.index')->with('error', 'Active subcategories cannot be deleted.');
        }

        // Proceed with deletion
        DB::table('courses_sub_categories')->where('id', $id)->delete();

        // Redirect with a success message
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully.');
    }

}
