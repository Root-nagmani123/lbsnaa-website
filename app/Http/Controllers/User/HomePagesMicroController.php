<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
use Carbon\Carbon;
class HomePagesMicroController extends Controller
{ 


    public function media_gallery()
    {
        // Fetch all data from the table using Query Builder
        $photoGalleries = DB::table('micro_manage_photo_galleries')->where('status', 1)->get();
        $courses = DB::table('course')->select('id', 'course_name')->get();
        // Pass data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries','courses'));
    }

    public function mediagallery()
    {
        return view('user.pages.microsites.mediagallery');
    }

    public function filterGallery(Request $request)
    {
        // Get filter inputs
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $year = $request->input('year');

        // Query for the gallery with filters
        $photoGalleries = DB::table('micro_manage_photo_galleries')
            ->join('course', 'course.id', '=', 'micro_manage_photo_galleries.course_id') // Join condition
            ->select(
                'micro_manage_photo_galleries.*',
                'course.course_name as course_name', // Ensure this matches the actual column name in your table
                'course.description as course_description'
            )
            ->when($keyword, function ($query, $keyword) {
                return $query->where('micro_manage_photo_galleries.image_title_english', 'like', "%$keyword%");
            })
            ->when($category, function ($query, $category) {
                return $query->where('micro_manage_photo_galleries.course_id', $category);
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('micro_manage_photo_galleries.created_at', $year);
            })
            ->where('micro_manage_photo_galleries.status', 1)
            ->get();

        // Fetch all courses for the dropdown
        $courses = DB::table('course')->select('id', 'course_name')->get();

        // Pass the data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'courses'));
    }


    public function calendar(Request $request)
    {
        // Get the current month and year, or use query parameters
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));

        // Create a Carbon instance for the given month and year
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        // Get the first day of the month (0 = Sunday, 1 = Monday, ...)
        $startDay = $date->dayOfWeek;

        return view('user.pages.microsites.calendar', compact('month', 'year', 'daysInMonth', 'startDay'));
    }

    public function news(Request $request)
    {
        // Fetch all records from the news table using the query builder
        $newsItems = DB::table('news')
            ->where('status', 1)
            ->get();

        // Pass the data to the view
        return view('user.pages.microsites.news', compact('newsItems'));
    }

    public function newsdetails($id)
    {
        // Fetch the specific news item by ID
        $news = DB::table('news')->where('id', $id)->first();

        // Decode the multiple images JSON array
        if ($news && $news->multiple_images) {
            $news->multiple_images = json_decode($news->multiple_images, true);
        }

        // Pass the news item to the view
        return view('user.pages.microsites.newsdetails', compact('news'));
    }



    // Method to show the video gallery
    public function videoGallery()
    {
        // Fetch all videos from the 'micro_video_galleries' table
        $videos = DB::table('micro_video_galleries')
            ->where('page_status', 1)  // Ensure only active videos are fetched
            ->get();

        // Pass the videos to the view
        return view('user.pages.microsites.video_gallery', compact('videos'));
    }























    // public function index()
    // {
    //     $sliders =  DB::table('sliders')->where('status',1)->where('is_deleted',0)->get();
    //     $news =  DB::table('news')->where('status',1)->get();
    //     $quick_links = DB::table('quick_links')->where('is_deleted',0)->where('status',1)->get();
    //     $news_scrollers=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->get();

    //     return view('user.pages.home', compact('sliders','news','quick_links','news_scrollers'));
    // } 
    // public function get_news($slug)
    // {

    //     $news =  DB::table('news')->where('status',1)->where('title_slug',$slug)->first();

    //     $news_images = explode(',', $news->multiple_images);

        
    //     return view('user.pages.newsbyslug', compact('news','news_images'));
    // }
    // public function generateBreadcrumb($currentMenuSlug)
    // {
    //     $breadcrumb = [];

    //     // Find the current menu by its slug
    //     $menu = DB::table('menus')
    //         ->where('menu_slug', $currentMenuSlug)
    //         ->where('menu_status', 1)
    //         ->where('is_deleted', 0)
    //         ->first();

    //     // Traverse up the parent hierarchy to build the breadcrumb
    //     while ($menu) {
    //         $breadcrumb[] = [
    //             'title' => $menu->menutitle,
    //             'slug' => $menu->menu_slug,
    //         ];

    //         $menu = DB::table('menus')
    //             ->where('id', $menu->parent_id)
    //             ->where('menu_status', 1)
    //             ->where('is_deleted', 0)
    //             ->first();
    //     }

    //     // Reverse to get breadcrumb from top-level to current menu
    //     return array_reverse($breadcrumb);
    // }
    // public function get_navigation_pages($slug)
    // {
    //     $breadcrumb = $this->generateBreadcrumb($slug);
    //     // echo 'hi';die;
    //     $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
    //     return view('user.pages.navigationpagesbyslug', compact('nav_page','breadcrumb'));
    // }
    // function footer_menu($slug){
    //     $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
    //     return view('user.pages.footer_details_page', compact('nav_page'));
    // }
    // function news_listing(){
    //     $news =  DB::table('news')->where('status',1)->get();
    
    //     return view('user.pages.newsList', compact('news'));
        
    // }
    // function letest_updates($slug){
    //     $nav_page=  DB::table('menus')->where('txtpostion',7)->where('is_deleted',0)->where('menu_status',1)->where('menu_slug',$slug)->first();
    
    //     return view('user.pages.letest_updates', compact('nav_page'));
        
    // }
    // function tenders(){
    //     return view('user.pages.tenders');
        
    // }


}
