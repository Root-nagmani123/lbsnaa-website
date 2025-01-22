<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\Menu;
class HomeFrontController extends Controller
{

    public function index()
    {
        $language = Cookie::get('language');
        date_default_timezone_set('Asia/Kolkata');
        $today = date('Y-m-d'); 
        $sliders =  DB::table('sliders')->where('status',1)->where('is_deleted',0) ->when($language == 2, function ($query) use ($language) {
            return $query->where('language', '2');
        })
        ->when($language == 1, function ($query) use ($language) {
            return $query->where('language', '1');
        })->orderBy('id', 'desc')->get();
        $news = DB::table('news')
        ->where('status', 1)
        ->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)
        ->when($language == 2, function ($query) use ($language) {
            return $query->where('language', '2');
        })
        ->when($language == 1, function ($query) use ($language) {
            return $query->where('language', '1');
        })
        ->get();
        $quick_links = DB::table('quick_links')->where('is_deleted',0)->where('status',1)->when($language == 2, function ($query) use ($language) {
            return $query->where('language', '2');
        })
        ->when($language == 1, function ($query) use ($language) {
            return $query->where('language', '1');
        })->get();
        $faculty_members = DB::table('faculty_members')->select('image')->where('designation','Director')->where('page_status',1)->first();
        $news_scrollers=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->when($language == 2, function ($query) use ($language) {
            return $query->where('language', '2');
        })
        ->when($language == 1, function ($query) use ($language) {
            return $query->where('language', '1');
        })->get();
        // print_r($faculty_members);die;
        
        $current_course = DB::table('course')
        ->join('courses_sub_categories', 'course.course_type', '=', 'courses_sub_categories.id')
        ->leftJoin('courses_sub_categories as parent_categories', 'courses_sub_categories.parent_id', '=', 'parent_categories.id') // Join to get parent category
        ->select(
            'course.id',
            'course.course_name',
            'course.coordinator_id',
            'course.course_start_date',
            'course.course_end_date', 
            'courses_sub_categories.status as child_status',
            'parent_categories.status as parent_status' // Include parent status
        )
        ->where('course.course_start_date', '<=', $today)
        ->where('course.course_end_date', '>=', $today)
        ->where('course.page_status', 1)
        ->where('courses_sub_categories.status', 1) // Filter for active child categories
        ->where(function ($query) {
            $query->whereNull('parent_categories.status') // Include records with no parent
                  ->orWhere('parent_categories.status', 1); // Or active parent categories
        })
        ->get();
    

        $upcoming_course = DB::table('course')
        ->join('courses_sub_categories', 'course.course_type', '=', 'courses_sub_categories.id')
        ->leftJoin('courses_sub_categories as parent_categories', 'courses_sub_categories.parent_id', '=', 'parent_categories.id') // Join to get parent category
        ->select(
            'course.id',
            'course.course_name',
            'course.coordinator_id',
            'course.course_start_date',
            'course.course_end_date',
            'courses_sub_categories.status as child_status',
            'parent_categories.status as parent_status' // Include parent status
        )
        ->where('course.course_start_date', '>', $today)
        ->where('course.page_status', 1)
        ->where('courses_sub_categories.status', 1) // Filter for active child categories
        ->where(function ($query) {
            $query->whereNull('parent_categories.status') // Include records with no parent
                  ->orWhere('parent_categories.status', 1); // Or active parent categories
        })
        ->get();
    
            
        // print_r($upcoming_course);die;
        return view('user.pages.home', compact('sliders','news','quick_links','news_scrollers','faculty_members','current_course','upcoming_course'));
    } 
    public function get_news($slug)
    {

        $news =  DB::table('news')->where('status',1)->where('title_slug',$slug)->first();

        $news_images = json_decode($news->multiple_images);

        
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
            $query = DB::table('faculty_members')->where('page_status', 1)->where('category', 1);

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
        }elseif ($slug == 'organogram') {
            // echo 'joining';die;
           return redirect('organization');
        
        
        }elseif ($slug == 'faculty-responsibility') {
            // echo 'joining';die;
           return redirect('faculty_responsibility');
        
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
    public function news_old_listing(Request $request) {
        $today = date('Y-m-d');
    
        // Fetch the distinct years of news
        $currentYear = date('Y');
        $startingYear = 2010; // Change this to your desired starting year
        $years = range($currentYear, $startingYear);
    
        // Build the query for news
        $query = DB::table('news')
            ->where('status', 1)
            ->where('end_date', '<', $today);
    
        // Apply search filters if provided
        if ($request->filled('keywords')) {
            $query->where('title', 'like', '%' . $request->keywords . '%');
        }
        if ($request->filled('year')) {
            $query->whereYear('start_date', $request->year);
        }
    
        $news = $query->get();
    
        // Return view with news and years
        return view('user.pages.old_news', compact('news', 'years'));
    }
    
    function letest_updates($slug){
        $nav_page=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->where('menu_slug',$slug)->first();
    
        return view('user.pages.letest_updates', compact('nav_page'));
        
    }
    function tenders() {
        
        date_default_timezone_set('Asia/Kolkata'); // Set timezone to Asia/Kolkata
        $today = date('Y-m-d H:i:s'); // Include time for more precise filtering
        // dd($today);
        $query = DB::table('manage_tenders')
            ->where('status', 1)
            ->where('publish_date', '<=', $today)
            ->where('expiry_date', '>=', $today)
            ->get();
    
        return view('user.pages.tenders', compact('query'));
    }
    
    function tenders_archive(Request $request){
        date_default_timezone_set('Asia/Kolkata'); // Set timezone to Asia/Kolkata
        $today = date('Y-m-d H:i:s');
    
        // Fetch the distinct years of news
        $currentYear = date('Y');
        $startingYear = 2010; // Change this to your desired starting year
        $years = range($currentYear, $startingYear);
    
        // Build the query for news
        $query = DB::table('manage_tenders')
            ->where('status', 1)
            ->where('expiry_date', '<', $today);
    
        // Apply search filters if provided
        if ($request->filled('keywords')) {
            $query->where('title', 'like', '%' . $request->keywords . '%');
        }
        if ($request->filled('year')) {
            $query->whereYear('expiry_date', $request->year);
        }
    
       $query = $query->get();
          return view('user.pages.old_tenders',compact('query','years'));
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
        ->where('status', 1) 
        ->select('id','slug', 'category_name', 'color_theme')
        ->get();

    // Step 2: Fetch all subcategories in one query
    $subcategories = DB::table('courses_sub_categories')
        ->where('parent_id', '!=', 0) // Get all subcategories that have a parent
        ->where('status', 1) // Get all subcategories that have a parent
        ->select('id','slug', 'category_name', 'color_theme', 'parent_id')
        ->get();

    // Step 3: Fetch all courses in one query
    $courses = DB::table('course')
        ->leftJoin('section_category', 'course.support_section', '=', 'section_category.id')
        ->where('section_category.status', 1)
        ->where('course.page_status', 1)
        ->select(
            'course.id',
            'course.course_name',
            'course.coordinator_id',
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
                    'coordinator_id' => $course->coordinator_id,
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
        ->select('id', 'parent_id','slug','category_name', 'color_theme','description')
        ->first();
        // print_r($subcategory);die;
        if($subcategory->parent_id  == 0){
            $parent_category = $subcategory;
        }else{
            $parent_category = DB::table('courses_sub_categories')
            ->where('id', $subcategory->parent_id)
            ->where('status', 1)
            ->select('id', 'category_name', 'slug','color_theme','description')
            ->first();
        }
        
        // print_r($parent_category);die;

    // Step 2: Fetch all courses related to this subcategory
    $courses = []; 
    if ($subcategory) {
        $courses = DB::table('course')
            ->where('course_type', $subcategory->id)
            ->whereDate('course_end_date', '<', $currentDate)
            ->select('id', 'course_name', 'course_start_date', 'course_end_date', 'course_type')
            ->get();
    }

    // Step 3: Get the current course (ongoing course)
    $currentCourse = DB::table('course')
        ->where('course_type', $subcategory->id)
        ->whereDate('course_start_date', '<=', $currentDate)
        ->whereDate('course_end_date', '>=', $currentDate)
        ->get();

        $upcomingCourse = DB::table('course')
        ->where('course_type', $subcategory->id)
        ->whereDate('course_start_date', '>', $currentDate)
        ->get();
//  print_r($parent_category);die;
    return view('user.pages.course_list', compact('parent_category','subcategory', 'currentCourse', 'courses','upcomingCourse'));
}
function get_course_subcourse_list_pages(Request $request, $slug){
    $category = DB::table('courses_sub_categories')
    ->where('slug', $slug)
    ->where('status', 1)
    ->select('id', 'category_name', 'color_theme','description')
    ->first();


    $sub_category = DB::table('courses_sub_categories')
    ->where('parent_id', $category->id)
    ->where('status', 1)
    ->select('id', 'category_name', 'slug','color_theme','description')
    ->get();

return view('user.pages.course_subcourse_list', compact('category', 'sub_category'));
}

public function get_course_details_pages(Request $request, $slug)
{
    $currentDate = Carbon::now();
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
    $parentcategory = DB::table('courses_sub_categories')
                    ->where('id', $subcategory->parent_id) // Assuming 'course_type' relates to subcategory
                    ->first();
                    $courses_list = DB::table('course')
                    ->where('course_type', $course->course_type)
                    ->whereDate('course_end_date', '<', $currentDate)
                    ->select('id', 'course_name', 'course_start_date', 'course_end_date', 'course_type')
                    ->get();

    // Pass the course and subcategory to the view
    return view('user.pages.course_details', compact('parentcategory','course', 'subcategory','courses_list'));
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

    $souvenir = $query->select('id', 'product_title', 'product_discounted_price','product_price','product_type','document_upload', 'contact_email_id', 'upload_image', 'product_description')->where('product_status', '1')->get();

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
function audiogallery(){
    $media_data = DB::table('manage_media_centers')
    ->where('page_status',1)
    ->get(); 

    return view('user.pages.audiogallery',compact('media_data'));
    
}
function videogallery(){
    $media_data = DB::table('manage_video_centers')
    ->leftjoin('manage_media_categories', 'manage_video_centers.category_name', '=', 'manage_media_categories.id')
    ->where('page_status',1)
    ->select('manage_video_centers.*','manage_media_categories.name')
    ->get();

    return view('user.pages.videogallery',compact('media_data'));
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
        ->where('status', 1)
        ->get();
        $news = DB::table('news')
        ->when($keywords, function ($query, $keywords) {
            return $query->where('title', 'LIKE', '%' . $keywords . '%');
        })
        ->when($category, function ($query, $category) {
            return $query->where('title_slug', $category);
        })
        ->when($year, function ($query, $year) {
            return $query->whereYear('end_date', $year);
        })
        ->where('status', 1)
        ->select('id', 'title', 'title_slug', 'main_image')
        ->get();
        // print_r($news);die;

    return view('user.pages.photogallery', compact('media_cat','news'));
}
function view_all_photogallery(Request $request){
    
    $catid = $request->input('glrid');
    $type = $request->input('type');

if($type == 'gallery'){
    $media_d = DB::table('manage_photo_galleries')
    ->leftjoin('manage_media_categories', 'manage_photo_galleries.media_categories', '=', 'manage_media_categories.id')
        ->where('media_categories', $catid)
        ->where('manage_photo_galleries.status', 1)
        ->select('manage_photo_galleries.id','manage_photo_galleries.image_title_english','manage_photo_galleries.image_files','manage_media_categories.name')
        ->get();
        // print_r($media_d);
}else if($type == 'news'){
    $media_d = DB::table('news')->select('id','title','multiple_images','main_image')->where('id', $catid)->where('status', 1)->get();

}
  
    return view('user.pages.all_photogallery', compact('media_d','type'));
}
public function organization(Request $request)
{
    $orgChart = DB::table('organisation_chart')
        ->leftJoin('faculty_members as faculty', 'organisation_chart.employee_name', '=', 'faculty.id')
        ->select(
            'organisation_chart.id',
            'organisation_chart.employee_name',
            'organisation_chart.parent_id',
            'faculty.designation as designation', // Fetch designation from faculty_members table
            'faculty.description as description', // Fetch designation from faculty_members table
            'faculty.image as image', // Fetch designation from faculty_members table
            'faculty.email as email', // Fetch designation from faculty_members table
            'faculty.phone_pt_office as phone_pt_office', // Fetch designation from faculty_members table
            'faculty.name as name' // Fetch designation from faculty_members table
        )
        ->where('organisation_chart.status', 1)
        ->orderBy('organisation_chart.id')
        ->get();
    $orgChart = $orgChart->toArray();
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
public function faculty_responsibility(Request $request) {
    $query = DB::table('faculty_members')
        ->where('page_status', 1)
        ->select('name', 'email');
    // Apply keyword search if provided
    if ($request->has('keywords') && !empty($request->keywords)) {
        $query->where('name', 'LIKE', '%' . $request->keywords . '%');
    }
    $data = $query->get();
    foreach ($data as $key => $value) {
        // Officer Incharge
        $Officer = DB::table('section_category')
            ->leftJoin('sections', 'section_category.section_id', '=', 'sections.id')
            ->where('section_category.officer_Incharge', $value->email)
            ->select('sections.id as sections_id', 'sections.title as section_title', 'section_category.name as category_name')
            ->get()
            ->groupBy('sections_id')
            ->map(function ($items) {
                return [
                    'section_title' => $items->first()->section_title,
                    'categories' => $items->pluck('category_name')->toArray(),
                ];
            });

        // Deputy Incharge
        $Deputy = DB::table('section_category')
            ->leftJoin('sections', 'section_category.section_id', '=', 'sections.id')
            ->where('section_category.alternative_Incharge_1st', $value->email)
            ->select('sections.id as sections_id', 'sections.title as section_title', 'section_category.name as category_name')
            ->get()
            ->groupBy('sections_id')
            ->map(function ($items) {
                return [
                    'section_title' => $items->first()->section_title,
                    'categories' => $items->pluck('category_name')->toArray(),
                ];
            });

        // Append section data to the faculty member object
        $value->Officer_Incharge = $Officer;
        $value->Deputy_Incharge = $Deputy;
    }

    return view('user.pages.faculty_responsibility', compact('data'));
}
function upcoming_events(){
    date_default_timezone_set('Asia/Kolkata'); // Set timezone to Asia/Kolkata
    $today = date('Y-m-d H:i:s'); 
    // $upcoming_course = DB::table('course')
    // ->Join('courses_sub_categories', 'course.course_type', '=', 'courses_sub_categories.id')

    // ->select('course.id','course.course_name', 'course.coordinator_id', 'course.course_start_date', 'course.course_end_date')
    //    ->where('course_start_date', '>', $today)
    //     ->where('page_status', 1)
    //     ->where('courses_sub_categories.status', 1)
    //     ->get();

        $upcoming_course = DB::table('course')
        ->join('courses_sub_categories', 'course.course_type', '=', 'courses_sub_categories.id')
        ->leftJoin('courses_sub_categories as parent_categories', 'courses_sub_categories.parent_id', '=', 'parent_categories.id') // Join to get parent category
        ->select(
            'course.id',
            'course.course_name',
            'course.coordinator_id',
            'course.course_start_date',
            'course.course_end_date',
            'courses_sub_categories.status as child_status',
            'parent_categories.status as parent_status' // Include parent status
        )
        ->where('course.course_start_date', '>', $today)
        ->where('course.page_status', 1)
        ->where('courses_sub_categories.status', 1) // Filter for active child categories
        ->where(function ($query) {
            $query->whereNull('parent_categories.status') // Include records with no parent
                  ->orWhere('parent_categories.status', 1); // Or active parent categories
        })
        ->get();

        
        return view('user.pages.upcoming_events', compact('upcoming_course'));
}
function running_events(){
    date_default_timezone_set('Asia/Kolkata'); // Set timezone to Asia/Kolkata
    $today = date('Y-m-d H:i:s'); 

            $current_course = DB::table('course')
        ->join('courses_sub_categories', 'course.course_type', '=', 'courses_sub_categories.id')
        ->leftJoin('courses_sub_categories as parent_categories', 'courses_sub_categories.parent_id', '=', 'parent_categories.id') // Join to get parent category
        ->select(
            'course.id',
            'course.course_name',
            'course.coordinator_id',
            'course.course_start_date',
            'course.course_end_date', 
            'courses_sub_categories.status as child_status',
            'parent_categories.status as parent_status' // Include parent status
        )
        ->where('course.course_start_date', '<=', $today)
        ->where('course.course_end_date', '>=', $today)
        ->where('course.page_status', 1)
        ->where('courses_sub_categories.status', 1) // Filter for active child categories
        ->where(function ($query) {
            $query->whereNull('parent_categories.status') // Include records with no parent
                  ->orWhere('parent_categories.status', 1); // Or active parent categories
        })
        ->get();
        return view('user.pages.running_events', compact('current_course'));
}
function sitemap(){
    $quickLinks = DB::table('quick_links')->where('is_deleted',0)->where('status',1)->get();
    $footerLinks = DB::table('menus')->where('txtpostion',3)->where('menu_status',1)->get();
    $menuTree = $this->buildMenuTree();
    return view('user.pages.sitemap', compact('menuTree', 'quickLinks', 'footerLinks'));
    
}
private function buildMenuTree($parentId = null)
{
    $parentId = $parentId ?? 0;
    $menus = Menu::where('parent_id', $parentId)
        ->whereIn('txtpostion', [1, 2])
        ->where('is_deleted', 0)
        ->where('menu_status', 1)
        ->get();

    $tree = [];
    
    foreach ($menus as $menu) {
        $tree[] = [
            'id' => $menu->id,
            'title' => $menu->menutitle,
            'menu_slug' => $menu->menu_slug,
            'children' => $this->buildMenuTree($menu->id), // Recursive call
        ];
    }

    return $tree;
}
function search(Request $request){
    // Logic to handle search query
    $query = $request->input('query');

    // Perform a search and return results (you can integrate with an API or search engine here)
    
    return view('user.pages.search',compact('query'));
}
function screenReader(Request $request){
    $screenRender = DB::table('screenrender')->first();

    return view('user.pages.screenRender', compact('screenRender'));
}
function archive(Request $request){
    return view('user.pages.archive');
}
function set_language(Request $request,$lang) {
    $languages = ['1', '2']; // Supported languages
    if (in_array($lang, $languages)) {
        // Set the language cookie
        Cookie::queue('language', $lang, 60 * 24 * 30); // Set for 30 days
        
        // Set the application's locale based on the selected language
      
    }

    // Redirect back to the previous page or to the home page
    return redirect()->back();
}






}
