<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\ValidationException;

use App\Models\Admin\ManageAudit;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{
    public function login()
    {
        
        
        return view('auth.admin_login');
    }
    public function authenticate(Request $request)
{
    // print_r($_POST);die(); 
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'g-recaptcha-response' => 'required', 
    ]);
    // dd($request->input('g-recaptcha-response')); 
    // print_r($request->input('g-recaptcha-response'));die;
    $response = $request->input('g-recaptcha-response');
    $secret = '6LcnL6YqAAAAAFq4QQ4XTwhoLQCOBcR2iU7gWhJm';
    $remoteip = $request->ip();

    $verify = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => $secret,
        'response' => $response,
        'remoteip' => $remoteip,
    ]);

    $verifyResponse = $verify->json();
// print_r($verifyResponse);die;
    if (!$verifyResponse['success']) {
        return back()->withErrors(['captcha' => 'reCAPTCHA verification failed']);
    }

    // Retrieve the user by email
    $user = User::where('email', $request->email)
    ->where('status', 1)
    ->first();

    // Use Hash::check() to verify the password
    if ($user && Hash::check($request->password, $user->password)) {
        DB::table('user_login_details')->insert([
            'user_id' =>$user->id,
            'login_time' => now(),
            'action' => 'Login',
            'ip_address' => $request->ip(),
        ]);
     
        // Manually log the user in
        // echo '</div>';
        Auth::login($user);
        if (Auth::check()) {
            // Now you can safely do other actions, like redirecting manually
            print_r(Auth::user()); // This will print the logged-in user's data
        } else {
            print_r('Login failed!');
        }
       
        // print_r($user);
      
        // Store the logged-in user's ID in the session
        session(['user_id' => $user->id]);

        // Log the login action in the audit table
        ManageAudit::create([
            'Module_Name' => 'Login', // Static value
            'Time_Stamp' => time(), // Use Laravel's now() helper
            'Created_By' => $user->id, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Login', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);
       
        // Redirect to the intended route or a default page
        return redirect()->intended('admin');
    }
    if($user){
        DB::table('user_login_details')->insert([
            'user_id' =>$user->id,
            'login_time' => now(),
            'action' => 'Login failed',
            'ip_address' => $request->ip(),
        ]);
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
        'Time_Stamp' => time(), // Current timestamp
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
