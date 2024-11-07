<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login()
    {
        
        return view('auth.admin_login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Use Hash::check() to verify the password
        if ($user && Hash::check($request->password, $user->password)) {
            // Manually log the user in
          
            Auth::login($user);
            return redirect()->intended('admin');
        }
    
        // Throw an error if authentication fails
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}

    // public function logins(Request $request)
    // {
    //     // Assuming you validate and authenticate the user here
    //     $user = DB::table('users')
    //         ->where('email', $request->email)
    //         ->where('password', $request->password) // This is just an example; use hashing in production!
    //         ->first();

    //     if ($user) {
    //         // Store user ID in session
    //         session(['user_id' => $user->id]);

    //         return redirect()->route('admin.profile');
    //     } else {
    //         return back()->withErrors(['login' => 'Invalid credentials.']);
    //     }
    // }
   
} 
