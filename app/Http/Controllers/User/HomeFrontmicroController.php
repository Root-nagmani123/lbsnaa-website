<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\{ResearchCentre, MicroQuickLinks};
use DOMDocument;

class HomeFrontmicroController extends Controller
{
    public function index($slug = null)
    { 
        // Start the query to fetch data from 'micro_sliders' joined with 'research_centres'
        $sliders = DB::table('micro_sliders')
            ->join('research_centres', 'micro_sliders.research_centre', '=', 'research_centres.id')  // Join with 'research_centres'
            ->where('micro_sliders.status', 1)
            ->when($slug, function($query) use ($slug) {
                return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
            })
            ->select('micro_sliders.*', 'research_centres.research_centre_name as research_centre_name')
            ->get();

        $whatsNew = DB::table('micro_quick_links')
        ->join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id')  // Join with 'research_centres'
        ->where('micro_quick_links.categorytype', 1)
        ->where('micro_quick_links.status', 1)
        ->when($slug, function ($query) use ($slug) {
            return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
        })
        ->whereDate('micro_quick_links.start_date', '<=', now())  // Ensure start_date is before or equal to today
        ->whereDate('micro_quick_links.termination_date', '>=', now())  // Ensure termination_date is after or equal to today
        ->select('micro_quick_links.*', 'research_centres.research_centre_name as research_centre_name')
        ->get();


        $quickLinks = MicroQuickLinks::join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id')  // Join with 'research_centres'
        ->where('micro_quick_links.categorytype', 2)
        ->where('micro_quick_links.status', 1)
        ->when($slug, function ($query) use ($slug) {
            return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
        })
        ->whereDate('micro_quick_links.start_date', '<=', now())  // Ensure start_date is before or equal to today
        ->whereDate('micro_quick_links.termination_date', '>=', now())  // Ensure termination_date is after or equal to today
        ->where('micro_quick_links.language', $this->getLang())
        ->select('micro_quick_links.*', 'research_centres.research_centre_name as research_centre_name')
        ->get();

        // Fetch research centres, using the slug if it's provided
        // $query = DB::table('research_centres')->where('research_centres.status', 1);
        $query = ResearchCentre::where('research_centres.status', 1)->where('language', $this->getLang());

        $Title = $pageTitle = '';
        if ($slug) {
            // Filter by research_centre_slug if provided
            $query->where('research_centre_slug', $slug);
            
            // Fetch the research centre name dynamically
            $researchCentre = $query->first();
            
            if ($researchCentre) {
                $Title = ucwords(str_replace('-', ' ', $researchCentre->research_centre_name)). ' | Lal Bahadur Shastri National Academy of Administration';
                $pageTitle = $researchCentre->research_centre_name;
            }
        }
        $research_centres = $query->get();
        // Return the view with the necessary data
        return view('user.pages.microsites.index', compact('sliders', 'quickLinks', 'whatsNew', 'research_centres', 'slug','pageTitle','Title'));
    }




    public function generateBreadcrumb($currentMenuSlug)
    {
        $breadcrumb = [];

        // Find the current menu by its slug
        $menu = DB::table('micromenus')
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

            $menu = DB::table('micromenus')
                ->where('id', $menu->parent_id)
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->first();
        }
        // Reverse to get breadcrumb from top-level to current menu
        return array_reverse($breadcrumb);
    }

    public function get_navigation_pages(Request $request, $slug, $childSlug = null)
    {
        // Generate breadcrumb based on slug
        $breadcrumb = $this->generateBreadcrumb($slug);
        // Fetch data for rendering
        // $nav_page = DB::table('micromenus')
        //     ->where('menu_status', 1)
        //     ->where('is_deleted', 0)
        //     ->where('menu_slug', $slug)
        //     ->first();


        // Change for menu same name 14/01
        $main_slug = $request->query('slug', $slug);
        $nav_page = DB::table('micromenus')
            ->join('research_centres as rc', 'micromenus.research_centreid', '=', 'rc.id')  // Join with 'research_centres'
            ->where('menu_status', 1)
            ->where('is_deleted', 0)
            ->where('menu_slug', $slug)
            ->where('rc.research_centre_slug', $main_slug)
            ->first();

            // if ($nav_page) {
            //     $menu_slug = $nav_page->menu_slug;  // Get the 'menu_slug' from the query result
            //     $Title = ucfirst(str_replace('-', ' ', $menu_slug));  // Format the title
            //     // dd($dynamicTitle);
            // }

            if ($nav_page) {
                $menu_slug = $nav_page->menu_slug;  // Get the 'menu_slug' from the query result
                $research_centre_slug = $nav_page->research_centre_slug;  // Get the 'research_centre_slug' from the query result
            
                // Concatenate 'menu_slug' and 'research_centre_slug' with a pipe separator
                $Title = ucfirst(str_replace('-', ' ', $menu_slug)) . ' | ' . ucfirst(str_replace('-', ' ', $research_centre_slug));  // Format the title
            }
        // Change for menu same name 14/01


        $slug = $request->query('slug', $slug);

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
            // Dynamic title using the slug, you can customize the format as needed
    // $Title = ucfirst(str_replace('-', ' ', $slug)) . ' - Research Center Navigation';  // Example format
    // dd($Title);
        // Return view with variables
        return view('user.pages.microsites.navigationmenubyslug', compact('nav_page', 'breadcrumb','quickLinks','slug','Title'));
    }

}
