<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Admin\ManageAudit;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        // $user = 1;
        // session(['user_id' => $user]);
        return view('admin.change_password.index');
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/[A-Za-z]/|regex:/[0-9]/',
            'confirm_password' => 'required|same:new_password',
        ]);
    
        // Get the currently logged-in user
        $user = Auth::user();
    
        // Check if the old password matches the stored hash
        if (!Hash::check($request->old_password, $user->password)) {

            ManageAudit::create([
                'Module_Name' => 'Incorrect Password', // Static value
                'Time_Stamp' => time(), // Current timestamp
                'Created_By' => null, // ID of the authenticated user
                'Updated_By' => null, // No update on creation, so leave null
                'Action_Type' => 'Update', // Static value
                'IP_Address' => $request->ip(), // Get IP address from request
            ]);
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
    
        // Update the user's password with the new hashed password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        ManageAudit::create([
            'Module_Name' => 'Change Password', // Static value
            'Time_Stamp' => time(), // Current timestamp
            'Created_By' => null, // ID of the authenticated user
            'Updated_By' => null, // No update on creation, so leave null
            'Action_Type' => 'Update', // Static value
            'IP_Address' => $request->ip(), // Get IP address from request
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
