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

        $photoGalleries = DB::table('research_centres as rc') // Alias `research_centres` as `rc`
            ->join('micro_media_categories as mmc', 'rc.id', '=', 'mmc.research_centre')
            // ->join('micro_manage_photo_galleries as mmpg', 'mmpg.media_categories', '=', 'mmc.id') // Join `micro_media_categories` with `research_centres`
            ->where('rc.status', 1) // Ensure `research_centres` is active
            ->where('mmc.status', 1) // Ensure `micro_media_categories` is active
            ->where('rc.research_centre_slug', $slug) // Filter by the provided slug
            ->select(
                'rc.id as research_centre_id', // ID from `research_centres`
                'mmc.name as media_category_name',
                'mmc.category_image as category_image',
                'mmc.id as category_id',
            )
            ->get();

        $courses = DB::table('course')->select('id', 'course_name')->get();

        $categorys = DB::table('micro_media_categories as mc')
            ->join('research_centres as rc', 'mc.research_centre', '=', 'rc.id')
            ->where('mc.status', 1) // Filter by status (active news)
            ->where('rc.research_centre_slug', $slug) // Use the slug from the query string
            ->select('mc.name','mc.id','category_image')
            ->get();
        // dd($photoGalleries);
        
        // Pass data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'courses', 'slug', 'categorys'));
    }

    public function mediagallery(Request $request)
    {
        // Get the slug from the query parameters (URL)
        $slug = $request->query('slug');  // or $request->get('slug');
        // Fetch the research centre by slug
        $research_centre = DB::table('research_centres')->where('status', 1)
            ->where('research_centre_slug', $slug)
            ->first();

        // $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
        $quickLinks = DB::table('micro_quick_links')
        ->join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id')  // Join with 'research_centres'
        ->where('micro_quick_links.categorytype', 2)
        ->where('micro_quick_links.status', 1)
        ->when($slug, function ($query) use ($slug) {
            return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
        })
        ->whereDate('micro_quick_links.start_date', '<=', now())  // Ensure start_date is before or equal to today
        ->whereDate('micro_quick_links.termination_date', '>=', now())  // Ensure termination_date is after or equal to today
        ->select('micro_quick_links.*', 'research_centres.research_centre_name as research_centre_name')
        ->get();


        return view('user.pages.microsites.mediagallery', compact('quickLinks', 'research_centre', 'slug'));
    }

    public function filterGallery(Request $request)
    {
        // dd($request);
        // Get filter inputs
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $year = $request->input('year');
        $slug = $request->query('slug'); // Get the 'slug' from the query string

        // Query for the gallery with filters and slug
        $filterGallery = DB::table('micro_manage_photo_galleries')
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
                return $query->where('research_centres.research_centre_slug', $slug); // Filter by the slug
            })
            ->where('micro_manage_photo_galleries.status', 1)
            ->get();

        //    dd(filterGallery);
        // Pass the data to the view
        return view('user.pages.microsites.media_gallery', compact('filterGallery'));
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
            ->where(function ($query) {
                $query->where('mn.start_date', '<=', now()) // Start date is in the past or today
                    ->where(function ($query) {
                        $query->whereNull('mn.end_date') // End date is null (ongoing news)
                            ->orWhere('mn.end_date', '>=', now()); // Or end date is in the future
                    });
            })
            ->select('mn.id as managenews_id', 'mn.*', 'rc.*') // Include the primary key of managenews explicitly
            ->get();

        // Debugging to verify the data
        // dd($newsItems);

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
        // dd($news);

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
            // dd($videos);
        // Return view with data
        return view('user.pages.microsites.video_gallery', compact('videos', 'slug'));
    }
    
    public function show($id, Request $request)
    {
        $slug = $request->query('slug');
        // $category = DB::table('micro_media_categories')->where('slug', $slug)->first();

        $category = DB::table('micro_manage_photo_galleries as mmpg')
        ->join('micro_media_categories as mmc', 'mmpg.media_categories', '=', 'mmc.id') // Adjust column names
        ->where('mmpg.media_categories', $id) // Filter by ID
        ->where('mmpg.status', 1)
        ->select('mmpg.image_files', 'mmc.name') // Select all columns from media_categories and specific ones from categories
        ->get();

        // dd($category);

        if (!$category) abort(404, 'Category not found.');
        return view('user.pages.microsites.category_details', compact('category'));
    }

    public function mediaGalleryDetails($id, Request $request)
    {
        // Get the slug from the request
        $slug = $request->query('slug');

        // Fetch the gallery details based on ID and slug
        $gallery_details = DB::table('micro_manage_photo_galleries as mmpg')
            ->join('research_centres as rc', 'mmpg.research_centre', '=', 'rc.id')
            ->where('mmpg.media_categories', $id) // Filter by the category ID
            ->where('rc.research_centre_slug', $slug) // Filter by the slug
            ->select('mmpg.*', 'rc.research_centre_name')
            ->get(); // Fetch a single record

        if (!$gallery_details) {
            abort(404, 'Gallery not found');
        }
        // dd($gallery_details);
        // Pass data to the view
        return view('user.pages.microsites.media_gallery_details', compact('gallery_details'));
    }

    public function getAllOrganizations($slug)
    {
        // Fetch the data from the database
        $organizations = DB::table('mirco_organization_setups as org')
            ->join('research_centres as rc', 'org.research_centre', '=', 'rc.id')
            ->where('org.page_status', 1)
            ->where('rc.research_centre_slug', $slug)
            ->select('org.designation', 'org.email', 'org.program_description','org.main_image','org.employee_name','org.id')
            ->get();

        // If data is available, return the view with the data
        return view('user.pages.microsites.organizations', compact('organizations'));
    }
    





}
