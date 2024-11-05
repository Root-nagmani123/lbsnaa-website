<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/[A-Za-z]/|regex:/[0-9]/',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the currently logged-in user's ID
        $userId = session('user_id'); // Adjust based on how user sessions are managed
        // dd($userId);
        // Fetch the user's record from the database
        $user = DB::table('users')->where('id', $userId)->first();

        // Check if the old password matches the stored hash
        // if (!Hash::check($request->old_password, $user->password)) {
        //     return back()->withErrors(['old_password' => 'Old password is incorrect']);
        // }
        DB::table('users')
            ->where('id', $userId)
            ->update(['password' => Hash::make($request->new_password)]);
        // Hash the new password and update the database


        return back()->with('success', 'Password changed successfully!');
    }
}
