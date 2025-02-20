<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    // List all news
    public function index()
    {
        $permissions = DB::table('modules')->get();
        return view('admin.UserManagement.module_list', compact('permissions'));
        // echo 'hi';die;
    }
 
    public function store(Request $request)
{
    $request->validate([
        'parent' => 'required',
        'child' => 'nullable|string',
        'status' => 'required|in:0,1',
    ]);

    DB::table('modules')->insert([
        'parent' => $request->parent,
        'child' => $request->child,
        'status' => $request->input('status'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Cache success message
    Cache::put('success_message', 'Module added successfully!', 1);

    // Redirect using session-stored previous URL
    return redirect(session('url.previousdata', url('/')));
}


    // Update Permission
    public function update(Request $request, $id)
{
    $request->validate([
        'parent' => 'required',
        'child' => 'nullable|string',
    ]);

    DB::table('modules')->where('id', $id)->update([
        'parent' => $request->parent,
        'child' => $request->child,
        'status' => $request->status,
        'updated_at' => now(),
    ]);

    // Cache success message
    Cache::put('success_message', 'Module updated successfully!', 1);

    // Redirect using session-stored previous URL
    return redirect(session('url.previousdata', url('/')));
}


    // Delete Permission
    public function destroy($id)
    {
        DB::table('modules')->where('id', $id)->delete();
    
        // Cache success message
        Cache::put('success_message', 'Module deleted successfully!', 1);
    
        // Redirect using session-stored previous URL
        return redirect(session('url.previousdata', url('/')));
    }
    
    public function users_index()
{
    $user = Auth::user();
    $userId = $user->id;
    $user_type = $user->user_type;

    if ($user_type == 2) {
        $module_name = 'Manage User';
        $modules = DB::table('modules as m')
            ->join('user_permissions as up', function ($join) use ($userId) {
                $join->on('m.id', '=', 'up.module_id')
                    ->where('up.user_id', '=', $userId)
                    ->where('up.is_allowed', 1);
            })
            ->where('m.child', $module_name)
            ->where('m.status', 1)
            ->select('m.id', 'm.parent', 'm.child', 'm.status', 'up.is_allowed')
            ->get();

        if ($modules->isEmpty()) {
            // Cache error message
            Cache::put('error_message', 'You do not have permission to access this module.', 1);
            
            // Redirect using session-stored previous URL
            return redirect(session('url.previousdata', url('/')));
        }
    }

    $users = DB::table('users')->get();
    return view('admin.UserManagement.users.index', compact('users'));
}


    // Show add form
    public function users_create()
{
    $user = Auth::user();
    $userId = $user->id;
    $user_type = $user->user_type;

    if ($user_type == 2) {
        $module_name = 'Manage User';
        $modules = DB::table('modules as m')
            ->join('user_permissions as up', function ($join) use ($userId) {
                $join->on('m.id', '=', 'up.module_id')
                    ->where('up.user_id', '=', $userId)
                    ->where('up.is_allowed', 1);
            })
            ->where('m.child', $module_name)
            ->where('m.status', 1)
            ->select('m.id', 'm.parent', 'm.child', 'm.status', 'up.is_allowed')
            ->get();

        if ($modules->isEmpty()) {
            // Cache error message
            Cache::put('error_message', 'You do not have permission to access this module.', 1);
            
            // Redirect using session-stored previous URL
            return redirect(session('url.previousdata', url('/')));
        }
    }

    return view('admin.UserManagement.users.create');
}


    // Store a new user
    public function users_store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    DB::table('users')->insert([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'user_type' => 2,
        'password' => Hash::make($request->input('password')),
    ]);

    // Cache success message
    Cache::put('success_message', 'User added successfully!', 1);
    return redirect()->route('users.index');
    // Redirect using session-stored previous URL
}


    // Show edit form
    public function users_edit($id)
    {
        $user = Auth::user();
        $userId = $user->id;
        $user_type = $user->user_type;
    
        if ($user_type == 2) {
            $module_name = 'Manage User';
            $modules = DB::table('modules as m')
                ->Join('user_permissions as up', function ($join) use ($userId) {
                    $join->on('m.id', '=', 'up.module_id')
                        ->where('up.user_id', '=', $userId)
                        ->where('up.is_allowed', 1);
                })
                ->where('m.child', $module_name)
                ->where('m.status', 1)
                ->select('m.id', 'm.parent', 'm.child', 'm.status', 'up.is_allowed')
                ->get();
    
            if ($modules->isEmpty()) {
                // Cache error message
                Cache::put('error_message', 'You do not have permission to access this module.', 1);
                return redirect(session('url.previousdata', url('/')));
            }
        }
    
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.UserManagement.users.edit', compact('user'));
    }
    
    // Update a user
    public function users_update(Request $request, $id)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
    
        // Agar validation fail ho gaya toh errors ko cache me store karo
        if ($validator->fails()) {
            Cache::put('error_message', $validator->errors()->first(), 1); // Pehla error message store karega
            return redirect(session('url.previousdata', url('/')))->withErrors($validator)->withInput();
        }
    
        // Update user
        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') 
                ? Hash::make($request->input('password')) // Hash new password
                : DB::table('users')->where('id', $id)->value('password'), // Retain old password
        ]);
    
        // Success message cache me store karo
        Cache::put('success_message', 'User updated successfully!', 1);
    
        // Redirect using session-stored previous URL
        return redirect(session('url.previousdata', url('/')));
    }
    


    // Delete a user
    public function users_destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        Cache::put('success_message', 'User updated successfully!', 1);
        return redirect()->route('users.index');
    }
    public function updateStatus(Request $request, $id)
{
    // Find the user by ID
    $user = DB::table('users')->where('id', $id)->first();

    if ($user) {
        // Update the status
        DB::table('users')->where('id', $id)->update([
            'status' => $request->input('status') // Update status (1 or 2)
        ]);
        Cache::put('success_message', 'User status updated successfully!', 1);
        // Redirect back with a success message
        return redirect()->route('users.index');
    }
    Cache::put('error_message', 'User not found!', 1);
    return redirect()->route('users.index')->with('error', 'User not found!');
}

public function permissions($id)
{
    $user = DB::table('users')->find($id);
    $modules = DB::table('modules')->where('status',1)->get();
    $permissions = DB::table('user_permissions')
        ->where('user_id', $id)
        ->select('id','user_id','module_id','is_allowed')
        ->get(); 
    return view('admin.UserManagement.permissions', compact('user', 'modules', 'permissions'));
}

public function updatePermissions(Request $request)
{
    $validated = $request->validate([
        'module_id' => 'required|integer',
        'user_id' => 'required|integer',
        'is_allowed' => 'required|boolean',
    ]);

    $existingPermission = DB::table('user_permissions')
        ->where('user_id', $validated['user_id'])
        ->where('module_id', $validated['module_id'])
        ->first();

    if ($existingPermission) {
        // Update the existing permission
        DB::table('user_permissions')
            ->where('id', $existingPermission->id)
            ->update(['is_allowed' => $validated['is_allowed']]);
    } else {
        // Insert a new permission
        DB::table('user_permissions')->insert([
            'user_id' => $validated['user_id'],
            'module_id' => $validated['module_id'],
            'is_allowed' => $validated['is_allowed'],
        ]);
    }

    return response()->json(['success' => true]);
}

}