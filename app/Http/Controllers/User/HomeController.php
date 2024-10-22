<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve all slider items from the database
        $sliders =  DB::table('sliders')->where('status',1)->get();
        $news =  DB::table('menus')->where('menu_status',1)->where('txtpostion',7)->get();
        $quick_links = DB::table('quick_links')->where('status',1)->get();
        // Pass the carousel data to the view
        return view('user.pages.home', compact('sliders','quick_links','news'));
    }
}
