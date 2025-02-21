<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'language' => 'required', // Ensure 'language' exists in the 'languages' table
            'category_name' => 'required|string|max:255', // Category name should be a string and have a max length
            'color_theme' => 'nullable|string|max:50', // Color theme is optional but should be a string with max length
            'parent_id' => 'nullable|exists:courses_sub_categories,id', // Ensure parent_id exists in the same table
            'description' => 'required|string', // Description is required
            'status' => 'required|in:0,1', // Status should be either 0 or 1
        ];
    
        // **Custom Error Messages**
        $messages = [
            'language.required' => 'Language selection is required.',
            'category_name.required' => 'Category name is required.',
            'category_name.max' => 'Category name cannot exceed 255 characters.',
            'color_theme.max' => 'Color theme cannot exceed 50 characters.',
            'parent_id.exists' => 'The selected parent category does not exist.',
            'description.required' => 'Description is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selection.',
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
        $validatedData = $validator->validated();
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
        Cache::put('success_message', 'Category created successfully!', 1);

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
        $rules = [
            'language' => 'required', // Ensure 'language' exists in the 'languages' table
            'category_name' => 'required|string|max:255', // Category name should be a string and have a max length
            'color_theme' => 'nullable|string|max:50', // Color theme is optional but should be a string with max length
            'parent_id' => 'nullable|exists:courses_sub_categories,id', // Ensure parent_id exists in the same table
            'description' => 'required|string', // Description is required
            'status' => 'required|in:0,1', // Status should be either 0 or 1
        ];
    
        // **Custom Error Messages**
        $messages = [
            'language.required' => 'Language selection is required.',
            'category_name.required' => 'Category name is required.',
            'category_name.max' => 'Category name cannot exceed 255 characters.',
            'color_theme.max' => 'Color theme cannot exceed 50 characters.',
            'parent_id.exists' => 'The selected parent category does not exist.',
            'description.required' => 'Description is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selection.',
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
            Cache::put('success_message', 'Category updated successfully!', 1);

        return redirect()->route('subcategory.index')->with('success', 'Menu updated successfully.');
    }

    public function delete($id)
    {
        // Retrieve the record first
        $subcategory = DB::table('courses_sub_categories')->where('id', $id)->first();

        // Check if the record exists
        if (!$subcategory) {
            Cache::put('error_message', 'Subcategory  not found!', 1);

            return redirect()->route('subcategory.index')->with('error', 'Subcategory not found.');
        }

        // Check if the status is 1 (Inactive), and prevent deletion if true
        if ($subcategory->status == 1) {
            Cache::put('error_message', 'Active subcategories cannot be deleted!', 1);

            return redirect()->route('subcategory.index')->with('error', 'Active subcategories cannot be deleted.');
        }

        // Proceed with deletion
        DB::table('courses_sub_categories')->where('id', $id)->delete();

        // Redirect with a success message
        Cache::put('success_message', 'Subcategory deleted successfully!', 1);
        
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully.');
    }

}
