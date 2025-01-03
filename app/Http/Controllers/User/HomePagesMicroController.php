<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
use Carbon\Carbon;
class HomePagesMicroController extends Controller
{ 
    public function media_gallery(Request $request)
    {
        // Get the 'slug' from the request
        $slug = $request->query('slug');
        
        // Fetch all data from the photo galleries and research centres using a join
        $photoGalleries = DB::table('micro_manage_photo_galleries as photo_gallery')
            ->join('research_centres as research_centres', 'photo_gallery.research_centre', '=', 'research_centres.id')
            ->where('photo_gallery.status', 1)
            ->where('research_centres.research_centre_slug', $slug)  // Filter by the slug
            ->select('photo_gallery.*', 'research_centres.*')  // Select all columns from both tables
            ->get();
        
        // Fetch courses (if needed)
        $courses = DB::table('course')->select('id', 'course_name')->get();
        
        // Pass data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'courses', 'slug'));
    }

    public function mediagallery(Request $request)
    {
        // Get the slug from the query parameters (URL)
        $slug = $request->query('slug');  // or $request->get('slug');
        // Fetch the research centre by slug
        $research_centre = DB::table('research_centres')->where('status', 1)
            ->where('research_centre_slug', $slug)
            ->first();
        $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
        return view('user.pages.microsites.mediagallery', compact('quickLinks', 'research_centre', 'slug'));
    }
        


    // public function filterGallery(Request $request)
    // {
    //     // Get filter inputs
    //     $keyword = $request->input('keyword');
    //     $category = $request->input('category');
    //     $year = $request->input('year');

    //     // Query for the gallery with filters
    //     $photoGalleries = DB::table('micro_manage_photo_galleries')
    //         ->join('course', 'course.id', '=', 'micro_manage_photo_galleries.course_id') // Join condition
    //         ->select(
    //             'micro_manage_photo_galleries.*',
    //             'course.course_name as course_name', // Ensure this matches the actual column name in your table
    //             'course.description as course_description'
    //         )

    //         ->when($keyword, function ($query, $keyword) {
    //             return $query->where(function ($q) use ($keyword) {
    //                 $q->where('micro_manage_photo_galleries.image_title_english', 'like', "%$keyword%")
    //                   ->orWhere('micro_manage_photo_galleries.image_title_hindi', 'like', "%$keyword%");
    //             });
    //         })
            
    //         ->when($category, function ($query, $category) {
    //             return $query->where('micro_manage_photo_galleries.course_id', $category);
    //         })
    //         ->when($year, function ($query, $year) {
    //             return $query->whereYear('micro_manage_photo_galleries.created_at', $year);
    //         })
    //         ->where('micro_manage_photo_galleries.status', 1)
    //         ->get();

    //     // Fetch all courses for the dropdown
    //     $courses = DB::table('course')->select('id', 'course_name')->get();

    //     // Pass the data to the view
    //     return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'courses'));
    // }

    public function filterGallery(Request $request)
    {
        // Get filter inputs
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $year = $request->input('year');
        $slug = $request->query('slug');  // Get the 'slug' from the query string

        // Query for the gallery with filters and slug
        $photoGalleries = DB::table('micro_manage_photo_galleries')
            ->join('course', 'course.id', '=', 'micro_manage_photo_galleries.course_id') // Join condition
            ->join('research_centres', 'research_centres.id', '=', 'micro_manage_photo_galleries.research_centre') // Join with research_centres table
            ->select(
                'micro_manage_photo_galleries.*',
                'course.course_name as course_name', // Ensure this matches the actual column name in your table
                'course.description as course_description',
                'research_centres.research_centre_slug' // Select slug for reference
            )
            ->when($keyword, function ($query, $keyword) {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('micro_manage_photo_galleries.image_title_english', 'like', "%$keyword%")
                    ->orWhere('micro_manage_photo_galleries.image_title_hindi', 'like', "%$keyword%");
                });
            })
            ->when($category, function ($query, $category) {
                return $query->where('micro_manage_photo_galleries.course_id', $category);
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('micro_manage_photo_galleries.created_at', $year);
            })
            ->when($slug, function ($query, $slug) {
                return $query->where('research_centres.research_centre_slug', $slug);  // Filter by the slug
            })
            ->where('micro_manage_photo_galleries.status', 1)
            ->get();

        // Fetch all courses for the dropdown
        $courses = DB::table('course')->select('id', 'course_name')->get();
            dd($courses);
        // Pass the data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'courses'));
    }

    public function news(Request $request)
    {
        // Get the slug from the request
        $slug = $request->query('slug'); // Fetch the 'slug' query parameter from the URL
        // Fetch all records from the managenews table joined with research_centres table
        $newsItems = DB::table('managenews as mn')
            ->join('research_centres as rc', 'mn.research_centreid', '=', 'rc.id') // Join the tables based on research_centreid
            ->where('mn.status', 1) // Filter by status (active news)
            ->where('rc.research_centre_slug', $slug) // Filter by research_centre_slug from the request slug
            ->select('mn.*', 'rc.*') // Select all columns from managenews and research_centres
            ->get();
        // Pass the data to the view
        return view('user.pages.microsites.news', compact('newsItems'));
    }


    public function newsdetails(Request $request, $id)
    {
        // Get the slug from the request (query parameter) or from the route parameter if it's provided
        $slug = $request->query('slug'); // Fetch the 'slug' query parameter from the URL

        // Fetch the specific news item by ID and Slug
        $news = DB::table('managenews')
            ->join('research_centres as rc', 'managenews.research_centreid', '=', 'rc.id') // Join with the research_centres table
            ->where('managenews.id', $id) // Filter by the specific news ID
            ->where('rc.research_centre_slug', $slug) // Filter by the research centre slug from the request
            ->where('managenews.status', 1) // Ensure the news is active
            ->select('managenews.*', 'rc.*') // Select all columns from managenews and research_centres
            ->first(); // Fetch a single result

        // Decode the multiple images JSON array
        if ($news && $news->multiple_images) {
            $news->multiple_images = json_decode($news->multiple_images, true);
        }

        // Pass the news item to the view
        return view('user.pages.microsites.newsdetails', compact('news'));
    }

    public function videoGallery(Request $request)
    {
        // Get the 'slug' parameter from the request
        $slug = $request->query('slug');
    
        // Fetch video gallery data with research centres
        $videos = DB::table('micro_video_galleries as video_gallery')
            ->join('research_centres as research_centres', 'video_gallery.research_centre', '=', 'research_centres.id') // Join research centres
            ->select(
                'video_gallery.*',  // Select all columns from video_gallery
                'research_centres.research_centre_slug as centre_name', // Custom name for research centre
                'research_centres.research_centre_slug as centre_slug' // Slug column
            )
            ->where('video_gallery.page_status', 1) // Only active videos
            ->when($slug, function ($query, $slug) {
                return $query->where('research_centres.research_centre_slug', $slug); // Filter by slug if provided
            })
            ->get();
   
        // Return view with data
        return view('user.pages.microsites.video_gallery', compact('videos', 'slug'));
    }
    
    





}
