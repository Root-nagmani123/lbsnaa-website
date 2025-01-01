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
        // echo 'test';die;
        // Fetch all data from the table using Query Builder
        $photoGalleries = DB::table('micro_manage_photo_galleries')->where('status', 1)->get();
        $courses = DB::table('course')->select('id', 'course_name')->get();
        // Pass data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries','courses'));
    }

    // public function mediagallery($slug = null)
    // {
    //     $query = DB::table('research_centres')->where('status', 1);
    //     if ($slug) {
    //         // Filter by research_centre_slug if provided
    //         $query->where('research_centre_slug', $slug);
    //     }
    //     $research_centres = $query->get();

    //     $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
    //     return view('user.pages.microsites.mediagallery',compact('quickLinks','research_centres','slug'));
    // }

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
        $newsItems = DB::table('managenews')
            ->where('status', 1)
            ->get();

        // Pass the data to the view
        return view('user.pages.microsites.news', compact('newsItems'));
    }

    public function newsdetails($id)
    {
        // Fetch the specific news item by ID
        $news = DB::table('managenews')->where('id', $id)->first();

        // Decode the multiple images JSON array
        if ($news && $news->multiple_images) {
            $news->multiple_images = json_decode($news->multiple_images, true);
        }

        // Pass the news item to the view
        return view('user.pages.microsites.newsdetails', compact('news'));
    }



    // // Method to show the video gallery
    // public function videoGallery()
    // {
    //     // Fetch all videos from the 'micro_video_galleries' table
    //     $videos = DB::table('micro_video_galleries')
    //         ->where('page_status', 1)  // Ensure only active videos are fetched
    //         ->get();

    //     // Pass the videos to the view
    //     return view('user.pages.microsites.video_gallery', compact('videos'));
    // }

    public function videoGallery($slug = null)
    {
        // Fetch videos from the 'micro_video_galleries' table, filtered by the slug if provided
        $query = DB::table('micro_video_galleries')
            ->where('page_status', 1);  // Ensure only active videos are fetched

        if ($slug) {
            // If the slug is provided, filter the videos by it (you can adjust this as needed)
            $query->where('slug', $slug);  // Example: assuming the videos table has a 'slug' field
        }

        $videos = $query->get();  // Get the results

        // Pass the videos and slug to the view
        return view('user.pages.microsites.video_gallery', compact('videos', 'slug'));
    }



}
