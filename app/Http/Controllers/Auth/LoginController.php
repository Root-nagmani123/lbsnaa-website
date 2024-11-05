<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Assuming you validate and authenticate the user here
        $user = DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password) // This is just an example; use hashing in production!
            ->first();

        if ($user) {
            // Store user ID in session
            session(['user_id' => $user->id]);

            return redirect()->route('admin.profile');
        } else {
            return back()->withErrors(['login' => 'Invalid credentials.']);
        }
    }
}
