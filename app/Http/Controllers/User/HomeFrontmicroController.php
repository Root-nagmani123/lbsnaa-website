<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DOMDocument;

class HomeFrontmicroController extends Controller
{
    // public function index($slug)
    // { 
    //     // dd($slug);
    //     $sliders =  DB::table('micro_sliders')->where('status', 1)->get();
    //     $whatsNew = DB::table('micro_quick_links')->where('categorytype', 1)->where('status', 1)->get();
    //     $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
    //     // Fetch research centres by slug
    //     $research_centres = DB::table('research_centres')
    //     ->where('status', 1)
    //     ->where('research_centre_slug', 'like', "%{$slug}%")
    //     ->get(); 

    //     // dd($research_centres);

    //     return view('user.pages.microsites.index', compact('sliders', 'quickLinks', 'whatsNew','research_centres'));
    // }

    public function index($slug = null)
    { 
        // Fetch all sliders, quick links, and what's new data
        $sliders = DB::table('micro_sliders')->where('status', 1)->get();
        $whatsNew = DB::table('micro_quick_links')->where('categorytype', 1)->where('status', 1)->get();
        $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();

        // Fetch research centres, using the slug if it's provided
        $query = DB::table('research_centres')->where('status', 1);
        
        if ($slug) {
            // If slug is provided, filter by it
            $query->where('research_centre_slug', 'like', "%{$slug}%");
        }

        // Get the results
        $research_centres = $query->get(); 

        // Return the view with the necessary data
        return view('user.pages.microsites.index', compact('sliders', 'quickLinks', 'whatsNew', 'research_centres'));
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

    public function get_navigation_pages($slug)
    {
        $breadcrumb = $this->generateBreadcrumb($slug);
        $quickLinks = DB::table('micro_quick_links')->where('categorytype', 2)->where('status', 1)->get();
        $nav_page =  DB::table('micromenus')->where('menu_status', 1)->where('is_deleted', 0)->where('menu_slug', $slug)->first();
        
        return view('user.pages.microsites.navigationmenubyslug', compact('nav_page', 'breadcrumb', 'quickLinks'));
    }
}
