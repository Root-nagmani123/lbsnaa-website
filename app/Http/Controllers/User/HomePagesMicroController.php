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
        $Title = "Media gallery";
        $slug = $request->query('slug');
        $keyword = $request->query('keyword');
        $category = $request->query('category');
        $year = $request->query('year');

        // Build the query
        $query = DB::table('research_centres as rc') // Alias `research_centres` as `rc`
            ->join('micro_media_categories as mmc', 'rc.id', '=', 'mmc.research_centre')
            ->where('rc.status', 1) // Ensure `research_centres` is active
            ->where('mmc.status', 1) // Ensure `micro_media_categories` is active
            ->where('mmc.media_gallery', 1) // Ensure it's a media gallery category
            ->where('rc.research_centre_slug', $slug) // Filter by the provided slug
            ->select(
                'rc.id as research_centre_id', // ID from `research_centres`
                'mmc.name as media_category_name',
                'mmc.category_image as category_image',
                'mmc.id as category_id',
                'mmc.created_at'
            );

        // Apply filters if provided
        if ($keyword) {
            $query->where('mmc.name', 'LIKE', "%{$keyword}%");
        }

        if ($category) {
            $query->where('mmc.id', $category);
        }

        if ($year) {
            $query->whereYear('mmc.created_at', $year);
        }

        // Execute the query and fetch results
        $photoGalleries = $query->get();

        // Pass data to the view
        return view('user.pages.microsites.media_gallery', compact('photoGalleries', 'slug','Title'));
    }


    public function mediagallery(Request $request)
    {
        // Get the slug from the query parameters (URL)
        $slug = $request->query('slug');  // or $request->get('slug');
        // Fetch the research centre by slug
        $research_centre = DB::table('research_centres')->where('status', 1)
            ->where('research_centre_slug', $slug)
            ->first();

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

            if ($research_centre) {
                $research_centre_slug = $research_centre->research_centre_slug;  // Get the first news item and its associated research_centre_slug
    
                // Concatenate the research centre slug with the title
                $Title = "Media gallery  | " . ucfirst(str_replace('-', ' ', $research_centre_slug));
            }

        return view('user.pages.microsites.mediagallery', compact('quickLinks', 'research_centre', 'slug','Title'));
    }

    public function news(Request $request)
    {
        // Get the slug from the request
        $slug = $request->query('slug'); // Fetch the 'slug' query parameter from the URL
        $Title = "Latest News";
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

        if ($newsItems->isNotEmpty()) {
            $research_centre_slug = $newsItems->first()->research_centre_slug;  // Get the first news item and its associated research_centre_slug

            // Concatenate the research centre slug with the title
            $Title = "Latest News | " . ucfirst(str_replace('-', ' ', $research_centre_slug));
        }
        // Debugging to verify the data
        // dd($newsItems);

        // Pass the data to the view
        return view('user.pages.microsites.news', compact('newsItems', 'slug', 'Title'));
    }




    public function newsdetails(Request $request, $id)
    {
        // Get the slug from the request (query parameter) or from the route parameter if it's provided
        $slug = $request->query('slug'); // Fetch the 'slug' query parameter from the URL
        $news = DB::table('managenews')
            ->join('research_centres as rc', 'managenews.research_centreid', '=', 'rc.id') // Join with the research_centres table
            ->where('managenews.id', $id) // Filter by the specific news ID
            ->where('rc.research_centre_slug', $slug) // Filter by the research centre slug from the request
            ->where('managenews.status', 1) // Ensure the news is active
            ->select('managenews.*') // Select all columns from managenews and research_centres
            ->first(); // Fetch a single result

        if ($news) {
            $Title = $news->title . ' | Latest News'; // Concatenate news title with "Latest News"
        }
        // Decode the multiple images JSON array
        if ($news && $news->multiple_images) {
            $news->multiple_images = json_decode($news->multiple_images, true);
        }
        // Pass the news item to the view
        return view('user.pages.microsites.newsdetails', compact('news', 'slug', 'Title'));
    }

    public function archive(Request $request, $slug)
    {
        // Use the slug from the route parameter instead of fetching it from the query string
        $slug = $request->route('slug');
        $Title = "Archive";
        // Fetch all records from the managenews table joined with research_centres table
        $archives = DB::table('managenews as mn')
            ->join('research_centres as rc', 'mn.research_centreid', '=', 'rc.id') // Join the tables based on research_centreid
            ->where('mn.status', 1) // Filter by status (active news)
            ->where('rc.research_centre_slug', $slug) // Filter by research_centre_slug from the slug parameter
            ->where('mn.start_date', '<=', now()) // Start date is in the past or today
            ->where(function ($query) {
                $query->whereNotNull('mn.end_date') // Ensure end_date is not null
                    ->where('mn.end_date', '<', now()); // Include only expired records (end_date is in the past)
            })
            ->select('mn.id as managenews_id', 'mn.*', 'rc.*') // Include the primary key of managenews explicitly
            ->get();

        // Pass the data to the view
        return view('user.pages.microsites.archive', compact('archives', 'slug','Title'));
    }



    public function archive_details(Request $request, $id)
    {
        // Get the slug from the request (query parameter) or from the route parameter if it's provided
        $slug = $request->query('slug'); // Fetch the 'slug' query parameter from the URL
        // dd($id);
        $Title = "Archive_Details";
        // Fetch the specific news item by ID and Slug
        $archive_details = DB::table('managenews')
            ->join('research_centres as rc', 'managenews.research_centreid', '=', 'rc.id') // Join with the research_centres table
            ->where('managenews.id', $id) // Filter by the specific news ID
            ->where('rc.research_centre_slug', $slug) // Filter by the research centre slug from the request
            ->where('managenews.status', 1) // Ensure the news is active
            ->select('managenews.*') // Select all columns from managenews and research_centres
            ->first(); // Fetch a single result
        // dd($news);
        // Decode the multiple images JSON array
        if ($archive_details && $archive_details->multiple_images) {
            $archive_details->multiple_images = json_decode($archive_details->multiple_images, true);
        }
        // dd($archive_details);

        // Pass the news item to the view
        return view('user.pages.microsites.archive_details', compact('archive_details', 'slug', 'Title'));
    }


    public function videoGallery(Request $request)
    {
        // Get the 'slug' parameter from the request
        $slug = $request->query('slug');
        $Title = "videoGallery";
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
        return view('user.pages.microsites.video_gallery', compact('videos', 'slug', 'Title'));
    }

    public function show($id, Request $request)
    {
        $Title = "Category Details";
        $slug = $request->query('slug');
        $category = DB::table('micro_manage_photo_galleries as mmpg')
            ->join('micro_media_categories as mmc', 'mmpg.media_categories', '=', 'mmc.id') // Adjust column names
            ->where('mmpg.media_categories', $id) // Filter by ID
            ->where('mmpg.status', 1)
            ->select('mmpg.image_files', 'mmc.name') // Select all columns from media_categories and specific ones from categories
            ->get();

        // dd($category);

        if (!$category) abort(404, 'Category not found.');
        return view('user.pages.microsites.category_details', compact('category', 'Title'));
    }

    public function mediaGalleryDetails($id, Request $request)
    {
        // Get the slug from the request
        $slug = $request->query('slug');
        $Title = "Media gallery details";
        // Fetch the gallery details based on ID and slug
        $gallery_details = DB::table('micro_manage_photo_galleries as mmpg')
            ->join('research_centres as rc', 'mmpg.research_centre', '=', 'rc.id')
            ->join('micro_media_categories as mmc', 'mmpg.media_categories', '=', 'mmc.id')

            ->where('mmpg.media_categories', $id) // Filter by the category ID
            ->where('rc.research_centre_slug', $slug) // Filter by the slug
            ->select('mmpg.*', 'rc.research_centre_name', 'mmc.name')
            ->get(); // Fetch a single record
        // dd($gallery_details);

        if (!$gallery_details) {
            abort(404, 'Gallery not found');
        }

        // Pass data to the view
        return view('user.pages.microsites.media_gallery_details', compact('gallery_details', 'slug', 'Title'));
    }

    public function getAllOrganizations($slug)
    {
        $Title = "Organizations";
        // Fetch the data from the database
        $organizations = DB::table('mirco_organization_setups as org')
            ->join('research_centres as rc', 'org.research_centre', '=', 'rc.id')
            ->where('org.page_status', 1)
            ->where('rc.research_centre_slug', $slug)
            ->select('org.designation', 'org.email', 'org.program_description', 'org.main_image', 'org.employee_name', 'org.id')
            ->get();

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

        // If data is available, return the view with the data
        return view('user.pages.microsites.organizations', compact('organizations', 'slug', 'quickLinks', 'Title'));
    }


    public function handleTrainingsPage(Request $request, $slug)
    {
        $Title = "Manage training programs";
        $slug = $request->query('slug', $slug);
        // Check if 'slug' is present
        if (!$slug) {
            return abort(400, 'Missing slug parameter.');
        }
        // Fetch the data from the database using the slug
        $today = Carbon::today();  // Get today's date

        $trainingprograms = DB::table('micro_manage_training_programs as mmtp')
            ->join('research_centres as rc', 'mmtp.research_centre', '=', 'rc.id')
            ->where('mmtp.page_status', 1)
            ->where('rc.research_centre_slug', $slug)
              ->select('mmtp.program_name', 'mmtp.venue', 'mmtp.start_date', 'mmtp.end_date', 'mmtp.registration_status', 'mmtp.id', 'rc.research_centre_slug')
              ->orderBy('mmtp.start_date', 'DESC')
            ->get();
            foreach ($trainingprograms as $program) {
                $program->start_date = Carbon::parse($program->start_date)->format('d-m-Y');
                $program->end_date = Carbon::parse($program->end_date)->format('d-m-Y');
            }

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
        // dd($trainingprograms);
        // Return the view with the training programs data
        return view('user.pages.microsites.training_program', compact('trainingprograms', 'quickLinks', 'slug', 'Title'));
    }

    public function details(Request $request, $id, $slug)
    {
        $Title = "Microsites training details";
        $slug = $request->query('slug', $slug);
        $today = now(); // Current date and time

        // Fetch training details using the provided ID
        $trainingdetails = DB::table('micro_manage_training_programs as mmtp')
            ->join('research_centres as rc', 'mmtp.research_centre', '=', 'rc.id')
            ->where('mmtp.page_status', 1)
            ->where('mmtp.id', $id) // Use ID directly passed from the route
            // ->whereDate('mmtp.start_date', '<=', $today) // Start date <= today
            // ->whereDate('mmtp.end_date', '>=', $today) // End date >= today
            ->select('rc.research_centre_slug', 'mmtp.program_name', 'mmtp.venue', 'mmtp.start_date', 'mmtp.end_date', 'mmtp.registration_status', 'mmtp.id', 'mmtp.program_coordinator', 'mmtp.program_description')
            ->first(); // Use first() instead of get() for a single record

        // Debugging to check the output (optional)
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

        // Return view with training details
        return view('user.pages.microsites.training_details', compact('trainingdetails', 'slug', 'quickLinks', 'Title'));
    }



    public function whatnewall(Request $request, $slug)
    {
        $slug = $request->query('slug', $slug);
        $Title = "Whats New";
        $today = now(); // Current date and time
        // Join the tables to get data from both 'micro_quick_links' and 'research_centres'
        $whatnewalls = DB::table('micro_quick_links')  // Start from the 'micro_quick_links' table
            ->join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id') // Join 'research_centres'
            ->where('research_centres.research_centre_slug', $slug)  // Filtering based on the slug
            ->where('micro_quick_links.categorytype', 1)
            ->where('micro_quick_links.status', 1)
            ->whereDate('micro_quick_links.start_date', '<=', now())  // Ensure start_date is before or equal to today
            ->whereDate('micro_quick_links.termination_date', '>=', now())  // Ensure termination_date is after or equal to today
            ->select('micro_quick_links.*')  // Select all columns from 'micro_quick_links'
            ->get();



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
        // dd($whatnewalls);  // For debugging, remove this after confirming the data

        // Pass the data and slug to the view
        return view('user.pages.microsites.whatnewall', compact('whatnewalls', 'quickLinks', 'slug', 'Title'));
    }
}
