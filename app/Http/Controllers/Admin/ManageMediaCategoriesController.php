<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageMediaCategories;
use Illuminate\Http\Request;

class ManageMediaCategoriesController extends Controller
{
    public function index()
    {
        $categories = ManageMediaCategories::all();
        return view('admin.manage_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('manage_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        ManageMediaCategories::create($validated);
        return redirect()->route('media-categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        return view('admin.manage_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'media_gallery' => 'required|in:Photo Gallery,Video Gallery',
            'name' => 'required|string',
            'hindi_name' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
        ]);

        $category = ManageMediaCategories::findOrFail($id);
        $category->update($validated);

        return redirect()->route('media-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = ManageMediaCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('media-categories.index')->with('success', 'Category deleted successfully.');
    }
}
