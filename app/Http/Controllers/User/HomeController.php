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

        return view('user.pages.home', compact('sliders','news','quick_links'));
    }
}
