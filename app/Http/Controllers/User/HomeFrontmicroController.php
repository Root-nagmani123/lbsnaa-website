<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // Fetch "quick links" and "what's new" based on the same condition
        $whatsNew = DB::table('micro_quick_links')
            ->join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id')  // Join with 'research_centres'
            ->where('micro_quick_links.categorytype', 1)
            ->where('micro_quick_links.status', 1)
            ->when($slug, function($query) use ($slug) {
                return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
            })
            ->select('micro_quick_links.*', 'research_centres.research_centre_name as research_centre_name')
            ->get();

        $quickLinks = DB::table('micro_quick_links')
            ->join('research_centres', 'micro_quick_links.research_centre_id', '=', 'research_centres.id')  // Join with 'research_centres'
            ->where('micro_quick_links.categorytype', 2)
            ->where('micro_quick_links.status', 1)
            ->when($slug, function($query) use ($slug) {
                return $query->where('research_centres.research_centre_slug', $slug);  // Filter by slug if provided
            })
            ->select('micro_quick_links.*', 'research_centres.research_centre_name as research_centre_name')
            ->get();

            // dd($quickLinks);

        // Fetch research centres, using the slug if it's provided
        $query = DB::table('research_centres')->where('research_centres.status', 1);
        if ($slug) {
            // Filter by research_centre_slug if provided
            $query->where('research_centres.research_centre_slug', $slug);
        }
        $research_centres = $query->get();
        // dd($research_centres);
        // Return the view with the necessary data
        return view('user.pages.microsites.index', compact('sliders', 'quickLinks', 'whatsNew', 'research_centres', 'slug'));
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

    // public function get_navigation_pages($slug)
    // {
       
    //     $breadcrumb = $this->generateBreadcrumb($slug);
    //     //  print_r($breadcrumb);die;
    //     $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
    //     $nav_page =  DB::table('micromenus')->where('menu_status', 1)->where('is_deleted', 0)->where('menu_slug', $slug)->first();
        
    //     return view('user.pages.microsites.navigationmenubyslug', compact('nav_page', 'breadcrumb', 'quickLinks'));
    // }

    // public function get_navigation_pages($slug, $childSlug = null)
    // {

    //     $breadcrumb = $this->generateBreadcrumb($slug);
    //     // dd($breadcrumb);
    //     $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
    //     $nav_page = DB::table('micromenus')->where('menu_status', 1)->where('is_deleted', 0)->where('menu_slug', $slug)->first();

    //     return view('user.pages.microsites.navigationmenubyslug', compact('nav_page', 'breadcrumb', 'quickLinks'));
    // }

    public function get_navigation_pages($slug, $childSlug = null)
    {
        // Generate breadcrumb based on slug
        $breadcrumb = $this->generateBreadcrumb($slug);
        // dd($breadcrumb);
        // Fetch data for rendering
        $nav_page = DB::table('micromenus')->where('menu_status', 1)->where('is_deleted', 0)->where('menu_slug', $slug)->first();
        $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();

        // Return view with variables
        return view('user.pages.microsites.navigationmenubyslug', compact('nav_page', 'breadcrumb', 'quickLinks'));
    }


}
