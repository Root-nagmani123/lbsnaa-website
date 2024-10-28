<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    public function index()
    {
        $sliders =  DB::table('sliders')->where('status',1)->get();
        $news =  DB::table('news')->where('status',1)->get();
        $quick_links = DB::table('quick_links')->where('status',1)->get();
        $news_scrollers=  DB::table('menus')->where('txtpostion',7)->where('menu_status',1)->get();

        return view('user.pages.home', compact('sliders','news','quick_links','news_scrollers'));
    }
    public function get_news($slug)
    {
        $news =  DB::table('news')->where('status',1)->where('slug',$slug)->first();
        $news_images = explode(',', $news->multiple_images);
        return view('user.pages.newsbyslug', compact('news','news_images'));
    }
}
