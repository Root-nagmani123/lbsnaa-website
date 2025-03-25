<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController 
{ 
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $recentLogins = DB::table('user_login_details as ul')
    ->join('users as u', 'ul.user_id', '=', 'u.id') // Join with the users table
    ->select('u.name as user_name', 'u.email as login_id', 'ul.login_time', 'ul.action', 'ul.ip_address')
    ->orderBy('ul.login_time', 'desc') // Sort by the latest login time
    ->limit(4) // Fetch only the 4 most recent records
    ->get();
        // echo 'hii';die;
        return view('admin.layouts.dashboard',compact('recentLogins'));
     
        // return view('admin.welcome'); // Pass the tree to the view
    }
    function getLang()
    {
        if (isset($_COOKIE['language'])) {
            $language = $_COOKIE['language'];
        } else {
            $language = 1;
        }
        return $language;
    }
}
