<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'parent' => 'required|unique:modules,parent',
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

        return redirect()->back()->with('success', 'modules added successfully!');
    }

    // Update Permission
    public function update(Request $request, $id)
    {
        $request->validate([
            'parent' => 'required|unique:modules,parent,' . $id,
            'child' => 'nullable|string',
        ]);

        DB::table('modules')->where('id', $id)->update([
            'parent' => $request->parent,
            'child' => $request->child,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'modules updated successfully!');
    }

    // Delete Permission
    public function destroy($id)
    {
        DB::table('modules')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'modules deleted successfully!');
    }
    public function users_index()
    {
        $users = DB::table('users')->get();
        return view('admin.UserManagement.users.index', compact('users'));
    }

    // Show add form
    public function users_create()
    {
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

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    // Show edit form
    public function users_edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.UserManagement.users.edit', compact('user'));
    }

    // Update a user
    public function users_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') 
                ? Hash::make($request->input('password')) // Hash the new password
                : DB::table('users')->where('id', $id)->value('password'), // Retain old hashed password
        ]);
        

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function users_destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
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

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User status updated successfully!');
    }

    return redirect()->route('users.index')->with('error', 'User not found!');
}

public function permissions($id)
{
    $user = DB::table('users')->find($id);
    $modules = DB::table('modules')->get();
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