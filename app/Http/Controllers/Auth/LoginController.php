<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

use App\Models\Admin\ManageAudit;

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

            ManageAudit::create([
                'Module_Name' => 'Login', // Static value
                'Time_Stamp' => now(), // Current timestamp
                'Created_By' => null, // ID of the authenticated user
                'Updated_By' => null, // No update on creation, so leave null
                'Action_Type' => 'Login', // Static value
                'IP_Address' => $request->ip(), // Get IP address from request
            ]);

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

    ManageAudit::create([
        'Module_Name' => 'Logout', // Static value
        'Time_Stamp' => now(), // Current timestamp
        'Created_By' => null, // ID of the authenticated user
        'Updated_By' => null, // No update on creation, so leave null
        'Action_Type' => 'Logout', // Static value
        'IP_Address' => $request->ip(), // Get IP address from request
    ]);

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
