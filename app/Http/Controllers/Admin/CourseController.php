<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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
         $rules = [
            'language' => 'required', 
            'course_name' => 'required|string|max:255', 
            'abbreviation' => 'required|string|max:50', 
            'meta_title' => 'required|string|max:255', 
            'meta_keyword' => 'nullable|string|max:255', 
            'coordinator_id' => 'required', 
            'important_links' => 'nullable', 
            'description' => 'nullable', 
            'course_type' => 'nullable|string|max:255', 
            'course_start_date' => 'required|date|after_or_equal:today', 
            'course_end_date' => 'required|date|after:course_start_date', 
            'support_section' => 'required', 
            'venue_id' => 'required', 
            'page_status' => 'required|in:0,1', 
        ];
    
        // **Custom Error Messages**
        $messages = [
            'language.required' => 'Language selection is required.',
            'course_name.required' => 'Course name is required.',
            'course_name.max' => 'Course name cannot exceed 255 characters.',
            'abbreviation.required' => 'Abbreviation is required.',
            'abbreviation.max' => 'Abbreviation cannot exceed 50 characters.',
            'meta_title.required' => 'Meta title is required.',
            'meta_title.max' => 'Meta title cannot exceed 255 characters.',
            'coordinator_id.required' => 'Coordinator ID is required.',
            'course_start_date.required' => 'Course start date is required.',
            'course_start_date.after_or_equal' => 'Start date cannot be in the past.',
            'course_end_date.required' => 'Course end date is required.',
            'course_end_date.after' => 'End date must be after the start date.',
            'support_section.required' => 'Support section is required.',
            'venue_id.required' => 'Venue ID is required.',
            'page_status.required' => 'Page status is required.',
            'page_status.in' => 'Invalid page status selection.',
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
        Cache::put('success_message', 'Course created successfully!', 1);
     
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
        Cache::put('success_message', 'Course updated successfully!', 1);

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
        Cache::put('success_message', 'Course deleted successfully!', 1);

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }
}
