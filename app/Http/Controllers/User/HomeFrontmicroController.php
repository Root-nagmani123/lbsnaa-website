<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use DOMDocument;
class HomeFrontmicroController extends Controller
{
    public function index()
    {
        $sliders =  DB::table('sliders')->where('status',1)->where('is_deleted',0)->get();
        return view('user.pages.microsites.index', compact('sliders'));
    } 
    
    
}
