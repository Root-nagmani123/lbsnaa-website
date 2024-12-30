<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
use Carbon\Carbon;
class HomeFrontController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $sliders =  DB::table('sliders')->where('status',1)->where('is_deleted',0)->get();
        $news =  DB::table('news')->where('status',1)->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)->get();
        $quick_links = DB::table('quick_links')->where('is_deleted',0)->where('status',1)->get();
        $faculty_members = DB::table('faculty_members')->select('image')->where('designation','Director')->where('page_status',1)->first();
        $news_scrollers=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->get();
        // print_r($faculty_members);die;
        
        $current_course = DB::table('course')
        ->select('id','course_name', 'coordinator_id', 'course_start_date', 'course_end_date')
            ->where('course_start_date', '<=', $today)
            ->where('course_end_date', '>=', $today)
            ->where('page_status', 1)
            ->get();

        $upcoming_course = DB::table('course')
        ->select('id','course_name', 'coordinator_id', 'course_start_date', 'course_end_date')
            ->where('course_start_date', '>', $today)
            ->where('page_status', 1)
            ->get();
            
        // print_r($upcoming_course);die;
        return view('user.pages.home', compact('sliders','news','quick_links','news_scrollers','faculty_members','current_course','upcoming_course'));
    } 
    public function get_news($slug)
    {

        $news =  DB::table('news')->where('status',1)->where('title_slug',$slug)->first();

        $news_images = explode(',', $news->multiple_images);

        
        return view('user.pages.newsbyslug', compact('news','news_images'));
    }
    public function generateBreadcrumb($currentMenuSlug)
    {
        $breadcrumb = [];

        // Find the current menu by its slug
        $menu = DB::table('menus')
            ->where('menu_slug', $currentMenuSlug)
            ->where('menu_status', 1)
            ->where('is_deleted', 0)
            ->first();

        // Traverse up the parent hierarchy to build the breadcrumb
        while ($menu) {
            $breadcrumb[] = [
                'title' => $menu->menutitle,
                'slug' => $menu->menu_slug,
            ];

            $menu = DB::table('menus')
                ->where('id', $menu->parent_id)
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->first();
        }

        // Reverse to get breadcrumb from top-level to current menu
        return array_reverse($breadcrumb);
    }
    public function get_navigation_pages(Request $request, $slug)
    {
        // echo $slug;die;
        if($slug == 'faculty'){
            $query = DB::table('faculty_members')->where('page_status', 1);

            // Check if a search keyword is provided
            if ($request->has('keywords') && !empty($request->keywords)) {
                $query->where('name', 'LIKE', '%' . $request->keywords . '%');
            }
        
            $faculty = $query->get();
        
            return view('user.pages.faculty', compact('faculty'));

        }elseif ($slug == 'staff') {
            $query = DB::table('staff_members')->where('page_status', 1);

            // Check if a search keyword is provided
            if ($request->has('keywords') && !empty($request->keywords)) {
                $query->where('name', 'LIKE', '%' . $request->keywords . '%');
            }

            $staff = $query->get();

         return view('user.pages.staff', compact('staff'));
        }elseif ($slug == 'organization') {
            // echo 'joining';die;
           return redirect('organization');
        
        }

        $breadcrumb = $this->generateBreadcrumb($slug);
       
        $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
        $director_img = '';
        if($slug == 'director-message' ){
        $director_img = DB::table('faculty_members')->select('image')->where('designation','Director')->where('page_status',1)->first();

        }
        return view('user.pages.navigationpagesbyslug', compact('nav_page','breadcrumb','director_img'));
    }
    function footer_menu($slug){
        if($slug == 'feedback'){
            return view('user.pages.feedback');
        }
        $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
        return view('user.pages.footer_details_page', compact('nav_page'));
    }
    function news_listing(){
        $today = date('Y-m-d');
        $news =  DB::table('news')->where('status',1)->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)->get();
    
        return view('user.pages.newsList', compact('news'));
        
    }
    function letest_updates($slug){
        $nav_page=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->where('menu_slug',$slug)->first();
    
        return view('user.pages.letest_updates', compact('nav_page'));
        
    }
    function tenders(){
        $today = date('Y-m-d');
        $query = DB::table('manage_tenders')->where('status', 1)->where('publish_date', '<=', $today)
        ->where('expiry_date', '>=', $today)->get();
        return view('user.pages.tenders',compact('query'));
        
    }
    function faculty(Request $request)
{
    $query = DB::table('faculty_members')->where('page_status', 1);

    // Check if a search keyword is provided
    if ($request->has('keywords') && !empty($request->keywords)) {
        $query->where('name', 'LIKE', '%' . $request->keywords . '%');
    }

    $faculty = $query->get();

    return view('user.pages.faculty', compact('faculty'));
}
function staff(Request $request)
{
    $query = DB::table('staff_members')->where('page_status', 1);

    // Check if a search keyword is provided
    if ($request->has('keywords') && !empty($request->keywords)) {
        $query->where('name', 'LIKE', '%' . $request->keywords . '%');
    }

    $staff = $query->get();

    return view('user.pages.staff', compact('staff'));
}

function vacancy(){
        
    $query = DB::table('manage_vacancies')->get();
    return view('user.pages.vacancy',compact('query'));
    
}
public function training_cal()
{
    // Step 1: Fetch all parent categories
    $parentCategories = DB::table('courses_sub_categories')
        ->where('parent_id', 0)  // Get only the parent categories
        ->select('id', 'category_name', 'color_theme')
        ->get();

    // Step 2: Fetch all subcategories in one query
    $subcategories = DB::table('courses_sub_categories')
        ->where('parent_id', '!=', 0) // Get all subcategories that have a parent
        ->select('id', 'category_name', 'color_theme', 'parent_id')
        ->get();

    // Step 3: Fetch all courses in one query
    $courses = DB::table('course')
        ->leftJoin('section_category', 'course.support_section', '=', 'section_category.id')
        ->select(
            'course.id',
            'course.course_name',
            'course.course_start_date',
            'course.course_end_date',
            'course.course_type', // This links the course to a subcategory
            'section_category.name as support_section'
        )
        ->get();

    // Step 4: Prepare organized data structure
    $organizedCategories = [];

    // Add parent categories to organized structure
    foreach ($parentCategories as $parent) {
        $organizedCategories[$parent->id] = [
            'name' => $parent->category_name,
            'color' => $parent->color_theme,
            'subcategories' => []
        ];
    }

    // Add subcategories to their respective parents
    foreach ($subcategories as $subcategory) {
        if (isset($organizedCategories[$subcategory->parent_id])) {
            $organizedCategories[$subcategory->parent_id]['subcategories'][$subcategory->id] = [
                'name' => $subcategory->category_name,
                'color' => $subcategory->color_theme,
                'courses' => []
            ];
        }
    }

    // Add courses to their respective subcategories
    foreach ($courses as $course) {
        foreach ($organizedCategories as &$parentCategory) {
            if (isset($parentCategory['subcategories'][$course->course_type])) {
                $parentCategory['subcategories'][$course->course_type]['courses'][] = [
                    'course_id' => $course->id,
                    'course_name' => $course->course_name,
                    'course_start_date' => $course->course_start_date,
                    'course_end_date' => $course->course_end_date,
                    'support_section' => $course->support_section
                ];
            }
        }
    }

    return view('user.pages.training_cal', compact('organizedCategories'));
}
public function get_course_list_pages(Request $request, $slug){
    $currentDate = Carbon::now();

    // Step 1: Fetch the subcategory
    $subcategory = DB::table('courses_sub_categories')
        ->where('slug', $slug)
        ->where('status', 1)
        ->select('id', 'category_name', 'color_theme','description')
        ->first();

    // Step 2: Fetch all courses related to this subcategory
    $courses = [];
    if ($subcategory) {
        $courses = DB::table('course')
            ->where('course_type', $subcategory->id)
            ->select('id', 'course_name', 'course_start_date', 'course_end_date', 'course_type')
            ->get();
    }

    // Step 3: Get the current course (ongoing course)
    $currentCourse = DB::table('course')
        ->where('course_type', $subcategory->id)
        ->whereDate('course_start_date', '<=', $currentDate)
        ->whereDate('course_end_date', '>=', $currentDate)
        ->first();

    return view('user.pages.course_list', compact('subcategory', 'currentCourse', 'courses'));
}

public function get_course_details_pages(Request $request, $slug)
{
    // Fetch the course based on the slug
    $course = DB::table('course')
                ->leftjoin('section_category', 'course.support_section', '=', 'section_category.id')
                ->leftjoin('manage_venues', 'course.venue_id', '=', 'manage_venues.id')
                ->where('course.id', '=', $slug) // Using 'slug' for matching
                ->select(
                    'course.*',
                    'section_category.name as section_name',
                    'manage_venues.venue_title'
                )
                ->first();

    // Check if course exists, if not return a 404 error or a suitable response
    if (!$course) {
        return abort(404, 'Course not found');
    }

    // Fetch the subcategory that the course belongs to
    $subcategory = DB::table('courses_sub_categories')
                    ->where('id', $course->course_type) // Assuming 'course_type' relates to subcategory
                    ->first();
                    $courses_list = DB::table('course')
                    ->where('course_type', $course->course_type)
                    ->select('id', 'course_name', 'course_start_date', 'course_end_date', 'course_type')
                    ->get();

    // Pass the course and subcategory to the view
    return view('user.pages.course_details', compact('course', 'subcategory','courses_list'));
}
public function souvenir(Request $request)
{
    // Fetch categories for the filter
    $categories = DB::table('souvenircategory')->select('id', 'category_name')->where('status', '1')->get();

    // Fetch products based on filters
    $query = DB::table('academy_souvenirs');
    if ($request->pro_category) {
        $query->where('product_category', $request->pro_category);
    }
    if ($request->producttype) {
        $query->where('product_type', $request->producttype);
    }
    $keywords = '';
    if ($request->keywords) {
        $keywords = $request->keywords;
        $query->where('product_title', 'LIKE', '%' . $request->keywords . '%');
    }

    $souvenir = $query->select('id', 'product_title', 'product_price', 'contact_email_id', 'upload_image', 'product_description')->where('product_status', '1')->get();

    // Return to view
    return view('user.pages.souvenir_list', compact('categories', 'souvenir','keywords'));
}
function rti_main_page(Request $request) {
    $slug = 'rti';

    // Generate breadcrumb
    $breadcrumb = $this->generateBreadcrumb($slug);
       
    // Fetch navigation page
    $nav_page = DB::table('menus')
        ->where('menu_status', 1)
        ->where('is_deleted', 0)
        ->where('menu_slug', $slug)
        ->first();

    // Get menu items
    $menuItems = $this->getMenuHierarchy($parentId = 0,$slug);
    // dd($menuItems);
    // print_r($menuItems);  // Shows the structure of $menuItems collection
    // die();  // Stop the script for debugging

    return view('user.pages.rti_page', compact('menuItems', 'nav_page', 'breadcrumb'));
}



private function getMenuHierarchy($parentId = 0, $slug = null) {
    // echo $slug;die;
    $query = DB::table('menus')
        ->where('menu_status', 1)
        ->where('is_deleted', 0)
        ->where('parent_id', $parentId);

    if ($slug !== null) {
        $query->where('menu_slug', $slug);
    }

    $menus = $query->orderBy('id')->get();

    foreach ($menus as $menu) {
        $menu->children = $this->getMenuHierarchy($menu->id); // Recursive call without slug
    }

    return $menus;
}

function get_rti_page_details(Request $request,$slug){
    $breadcrumb = $this->generateBreadcrumb($slug);
       
    // Fetch navigation page
    $nav_page = DB::table('menus')
        ->where('menu_status', 1)
        ->where('is_deleted', 0)
        ->where('menu_slug', $slug)
        ->first();

    // Get menu items
    $menuItems = $this->getMenuHierarchy($nav_page->parent_id,$slug);
    // dd($menuItems);
    // print_r($menuItems);  // Shows the structure of $menuItems collection
    // die();  // Stop the script for debugging

    return view('user.pages.rti_page', compact('menuItems', 'nav_page', 'breadcrumb'));
}
function feedback(Request $request){
    return view('user.pages.feedback');
}

    public function storeFeedback(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|regex:/^[6-9]\d{9}$/',
            'email' => 'required|email|max:255',
            'category' => 'required|integer',
            'comments' => 'required|string|max:500',
        ]);

        // Use Query Builder to insert the data
        DB::table('feedback')->insert([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'category' => $validated['category'],
            'comments' => $validated['comments'],
            'created_at' => now(),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
function mediagallery(){
    return view('user.pages.mediagallery');
}
function photogallery(Request $request){
    $keywords = $request->input('keywords');
    $category = $request->input('txtcategory');
    $year = $request->input('year');

    $media_cat = DB::table('manage_media_categories')
        ->when($keywords, function ($query, $keywords) {
            return $query->where('name', 'LIKE', '%' . $keywords . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('id', $category);
        })
        ->when($year, function ($query, $year) {
            return $query->whereYear('created_at', $year);
        })
        ->where('media_gallery', 'Photo Gallery')
        ->get();

    return view('user.pages.photogallery', compact('media_cat'));
}
function view_all_photogallery(Request $request){
    
    $catid = $request->input('glrid');

    $media_d = DB::table('manage_photo_galleries')
    ->leftjoin('manage_media_categories', 'manage_photo_galleries.media_categories', '=', 'manage_media_categories.id')
        ->where('media_categories', $catid)
        ->where('manage_photo_galleries.status', 1)
        ->select('manage_photo_galleries.id','manage_photo_galleries.image_title_english','manage_photo_galleries.image_files','manage_media_categories.name')
        ->get();
    return view('user.pages.all_photogallery', compact('media_d'));
}
public function organization(Request $request)
{
    // Fetch organization chart with faculty designations
    $orgChart = DB::table('organisation_chart')
        ->leftJoin('faculty_members as faculty', 'organisation_chart.faculty_id', '=', 'faculty.id')
        ->select(
            'organisation_chart.id',
            'organisation_chart.employee_name',
            'organisation_chart.parent_id',
            'faculty.designation as designation' // Fetch designation from faculty_members table
        )
        ->where('organisation_chart.status', 1)

        ->orderBy('organisation_chart.id')

        ->get();

    // Convert to an array for recursive manipulation
    $orgChart = $orgChart->toArray();

    // Build a hierarchy using a recursive function
    $hierarchy = $this->buildHierarchy($orgChart);
// print_r($hierarchy);die;
    return view('user.pages.organization', compact('hierarchy'));
}

// Recursive function to build the hierarchy
private function buildHierarchy($elements, $parentId = null)
{
    $branch = [];

    foreach ($elements as $element) {
        if ($element->parent_id == $parentId) {
            // Recursively fetch children
            $children = $this->buildHierarchy($elements, $element->id);
            if ($children) {
                $element->children = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}









}
