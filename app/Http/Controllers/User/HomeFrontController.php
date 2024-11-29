<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
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
        return view('user.pages.tenders');
        
    }
}
