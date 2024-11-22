<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class MicrositeController extends Controller
{
    public function index()
    {
        return view('user.pages.microsites.index', compact());
    }
}
