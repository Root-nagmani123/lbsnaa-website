<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = DB::table('course')->get();
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
        return view('admin.courses.create', compact('section_category','manage_venues','tree'));
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
         
    //     //
    //     $course = DB::table('course')->insert($request->except('_token'));
 
    //     ManageAudit::create([
    //         'Module_Name' => 'Course Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);


    //     return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    
    // }

    // public function store(Request $request)
    // {
    //     // Validate the input data
    //     $validatedData = $request->validate([
    //         'language' => 'required', // Language is required and must be a valid ID from languages table
    //         'course_name' => 'required|string|max:255', // Course name is required, must be a string, and max length of 255
    //         'abbreviation' => 'required|string|max:50', // Abbreviation is required, must be a string, and max length of 50
    //         'meta_title' => 'required|string|max:255', // Meta title is optional, must be a string, and max length of 255
    //         'meta_keyword' => 'nullable|string|max:255', // Meta keyword is optional, must be a string, and max length of 255
    //         'course_start_date' => 'required|date|after_or_equal:today', // Start date is required, must be a date and today or in the future
    //         'course_end_date' => 'required|date|after:course_start_date', // End date is required, must be a date, and after the start date
    //         'support_section' => 'required', // Support section is required and must be a valid ID from support_sections table
    //         'venue_id' => 'required', // Venue is required and must be a valid ID from venues table
    //         'registration_on' => 'required', // Venue is required and must be a valid ID from venues table
    //         'page_status' => 'required|in:0,1', // Venue is required and must be a valid ID from venues table
    //     ]);

    //     // Insert the validated data into the database
    //     DB::table('course')->insert($validatedData);

    //     // Log the action in the ManageAudit table
    //     ManageAudit::create([
    //         'Module_Name' => 'Course Module', // Static value
    //         'Time_Stamp' => time(), // Current timestamp
    //         'Created_By' => null, // ID of the authenticated user
    //         'Updated_By' => null, // No update on creation, so leave null
    //         'Action_Type' => 'Insert', // Static value
    //         'IP_Address' => $request->ip(), // Get IP address from request
    //     ]);

    //     // Redirect back to the courses index page with a success message
    //     return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    // }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'language' => 'required', // Language is required
            'course_name' => 'required|string|max:255', // Course name is required, must be a string, and max length of 255
            'abbreviation' => 'required|string|max:50', // Abbreviation is required, must be a string, and max length of 50
            'meta_title' => 'required', // Meta title is optional, must be a string, and max length of 255
            'meta_keyword' => 'nullable|string|max:255', // Meta keyword is optional, must be a string, and max length of 255
            // 'meta_description' => 'nullable|string|max:255', // Meta description is optional
            // 'description' => 'nullable|string', // Description is optional and can have any length
            'coordinator_id' => 'required', // Optional field, must be a valid user ID from the users table
            'asst_coordinator_1_id' => 'required', // Optional field, must be a valid user ID from the users table
            'important_links' => 'nullable|array', // Optional field that should be an array
            'course_type' => 'nullable|string|max:255', // Optional field for course type, should be a string
            'course_start_date' => 'required|date|after_or_equal:today', // Start date is required, must be a date and today or in the future
            'course_end_date' => 'required|date|after:course_start_date', // End date is required, must be a date, and after the start date
            'support_section' => 'required', // Support section is required
            'venue_id' => 'required', // Venue is required
             'page_status' => 'required|in:0,1', // Venue is required and must be either 0 or 1
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
        return view('admin.courses.edit', compact('course','section_category','manage_venues','tree'));
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
