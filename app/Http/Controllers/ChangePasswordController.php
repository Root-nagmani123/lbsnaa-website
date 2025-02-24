<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/[A-Za-z]/|regex:/[0-9]/',
            'confirm_password' => 'required|same:new_password',
        ];
    
        // Custom validation messages
        $messages = [
            'old_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.regex' => 'The new password must contain at least one letter and one number.',
            'confirm_password.required' => 'Please confirm your new password.',
            'confirm_password.same' => 'The confirm password must match the new password.',
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // **Cache validation errors for 1 minute**
            Cache::put('validation_errors', $validator->errors()->toArray(), 1);
    
            // **Redirect back with old input**
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        if($request->new_password !== $request->confirm_password){
            Cache::put('error_message', 'New password and confirm password do not match', 1);
            return redirect(session('url.previousdata', url('/')))->withInput();
        }
        // Get the currently logged-in user
        $user = Auth::user();
    
        // Check if the old password matches the stored hash
        if (!Hash::check($request->old_password, $user->password)) {
            // Log audit entry for incorrect password attempt
            ManageAudit::create([
                'Module_Name' => 'Incorrect Password',
                'Time_Stamp' => time(), // Laravel's current timestamp
                'Created_By' => $user->id, 
                'Updated_By' => null, 
                'Action_Type' => 'Update',
                'IP_Address' => $request->ip(),
            ]);
            Cache::put('error_message', 'Old password is incorrect', 1);

            return redirect(session('url.previousdata', url('/')))->withInput();
    
            // return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
    
        // **Check if the new password was used before (Password Reuse Prevention)**
        $oldPasswords = DB::table('password_histories')
            ->where('user_id', $user->id)
            ->pluck('password') // Fetch only hashed passwords
            ->toArray();
    
        foreach ($oldPasswords as $oldPassword) {
            if (Hash::check($request->new_password, $oldPassword)) {
                Cache::put('error_message', 'You cannot reuse an old password.', 1);

            return redirect(session('url.previousdata', url('/')))->withInput();
                // return back()->withErrors(['new_password' => 'You cannot reuse an old password.']);
            }
        }
    
        // **Update the user's password**
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        // **Store the new password in password history**
        DB::table('password_histories')->insert([
            'user_id' => $user->id,
            'password' => Hash::make($request->new_password), // Store hashed password
            'created_at' => now(),
        ]);
    
        // **Delete oldest password if more than 5 passwords exist**
        $totalPasswords = DB::table('password_histories')
            ->where('user_id', $user->id)
            ->count();
    
        if ($totalPasswords > 5) {
            DB::table('password_histories')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'asc') // Oldest first
                ->limit(1)
                ->delete();
        }
    
        // Log audit entry for successful password change
        ManageAudit::create([
            'Module_Name' => 'Change Password',
            'Time_Stamp' => time(),
            'Created_By' => $user->id,
            'Updated_By' => null,
            'Action_Type' => 'Update',
            'IP_Address' => $request->ip(),
        ]);
        Cache::put('success_message', 'Password changed successfully!', 1);

        return redirect(session('url.previousdata', url('/')))->withInput();
        // return back()->with('success', 'Password changed successfully!');
    }
    
}
