<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = DB::table('course')->orderBy('id','desc')->get();
        return view('admin.courses.index', compact('courses'));
        
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = DB::table('courses_sub_categories')
        ->select('id', 'parent_id', 'category_name')
        // ->where('status',1) // Ensure proper hierarchy order
        ->orderBy('parent_id') 
        ->get();

    // Build category tree
        $tree = $this->buildCategoryTree($categories);
        $section_category = DB::table('section_category')->select('id','name')->get();
        $manage_venues = DB::table('manage_venues')->where('status', 1)->select('id','venue_title')->get();
        $staff_members = DB::table('staff_members')->where('page_status', 1)->select('id','name')->get();
        $faculty_members = DB::table('faculty_members')->where('page_status', 1)->select('id','name')->get();
        return view('admin.courses.create', compact('section_category','manage_venues','tree','staff_members','faculty_members'));
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
     public function store(Request $request)
     {
         // Validate the input data
         $validatedData = $request->validate([
             'language' => 'required', 
             'course_name' => 'required|string|max:255', 
             'abbreviation' => 'required|string|max:50', 
             'meta_title' => 'required|string|max:255', 
             'meta_keyword' => 'nullable|string|max:255', 
             'coordinator_id' => 'required', 
             'asst_coordinator_1_id' => 'required', 
             'important_links' => 'nullable', 
             'description' => 'nullable', 
             'course_type' => 'nullable|string|max:255', 
             'course_start_date' => 'required|date|after_or_equal:today', 
             'course_end_date' => 'required|date|after:course_start_date', 
             'support_section' => 'required', 
             'venue_id' => 'required', 
             'page_status' => 'required|in:0,1', 
         ]);
     
         // Insert the validated data into the database
         DB::table('course')->insert($validatedData);
     
         // Log the action in the ManageAudit table
         ManageAudit::create([
            'Module_Name' => 'Course Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Insert', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
     
         // Redirect back to the courses index page with a success message
         return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
     }
     



    public function edit($id)
    {
        $categories = DB::table('courses_sub_categories')
        ->select('id', 'parent_id', 'category_name')
        // ->where('status',1) // Ensure proper hierarchy order
        ->orderBy('parent_id') 
        ->get();
        $tree = $this->buildCategoryTree($categories);
        $course = DB::table('course')->find($id);
        $section_category = DB::table('section_category')->select('id','name')->get();
        $manage_venues = DB::table('manage_venues')->where('status', 1)->select('id','venue_title')->get();
        $staff_members = DB::table('staff_members')->where('page_status', 1)->select('id','name')->get();
        $faculty_members = DB::table('faculty_members')->where('page_status', 1)->select('id','name')->get();
        return view('admin.courses.edit', compact('course','section_category','manage_venues','tree','staff_members','faculty_members'));
    }

    public function update(Request $request, $id)
    {
        $course = DB::table('course')->where('id', $id)->update($request->except('_token', '_method'));

        ManageAudit::create([
            'Module_Name' => 'Course Module', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }
    private function buildCategoryTree($categories, $parentId = 0, $prefix = '')
    {
        $output = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $category->name_with_prefix = $prefix . $category->category_name;
                $output[] = $category;
    
                // Recursive call for children
                $children = $this->buildCategoryTree($categories, $category->id, $prefix . '&nbsp;&nbsp;&nbsp;--');
                $output = array_merge($output, $children);
            }
        }
        return $output;
    }
    public function destroy($id)
    {
        DB::table('course')->where('id', $id)->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }
}
