<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

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
    public function get_navigation_pages($slug)
    {
        // echo 'hi';die;
        $nav_page =  DB::table('menus')->where('menu_status',1)->where('is_deleted',0)->where('menu_slug',$slug)->first();
        return view('user.pages.navigationpagesbyslug', compact('nav_page'));
    }
    function footer_menu($slug){
        echo $slug;
    }
}
