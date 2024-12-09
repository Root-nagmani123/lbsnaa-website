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
        $sliders =  DB::table('sliders')->where('status',1)->where('is_deleted',0)->get();
        $news =  DB::table('news')->where('status',1)->get();
        $quick_links = DB::table('quick_links')->where('is_deleted',0)->where('status',1)->get();
        $news_scrollers=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->get();

        return view('user.pages.home', compact('sliders','news','quick_links','news_scrollers'));
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
    public function get_navigation_pages($slug)
    {
        $breadcrumb = $this->generateBreadcrumb($slug);
        // echo 'hi';die;
        $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
        return view('user.pages.navigationpagesbyslug', compact('nav_page','breadcrumb'));
    }
    function footer_menu($slug){
        $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
        return view('user.pages.footer_details_page', compact('nav_page'));
    }
    function news_listing(){
        $news =  DB::table('news')->where('status',1)->get();
    
        return view('user.pages.newsList', compact('news'));
        
    }
    function letest_updates($slug){
        $nav_page=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->where('menu_slug',$slug)->first();
    
        return view('user.pages.letest_updates', compact('nav_page'));
        
    }
    function tenders(){
        
        $query = DB::table('manage_tenders')->get();
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






}
