<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewprofileController extends Controller
{
    public function index()
    {
        // Retrieve user ID from session
        $userId = session('user_id');
        // Fetch the user data directly from the database
        $user = DB::table('users')->where('id', $userId)->first();

        return view('admin.manage_profile.index', compact('user'));
    }
}
