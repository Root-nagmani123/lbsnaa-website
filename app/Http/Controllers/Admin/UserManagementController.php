<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\ManageAudit;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;





class UserManagementController extends Controller
{
    // List all news
    public function index()
    {
        $permissions = DB::table('permissions')->get();
        return view('admin.UserManagement.permission_list', compact('permissions'));
        // echo 'hi';die;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'description' => 'nullable|string',
        ]);

        DB::table('permissions')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Permission added successfully!');
    }

    // Update Permission
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'description' => 'nullable|string',
        ]);

        DB::table('permissions')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Permission updated successfully!');
    }

    // Delete Permission
    public function destroy($id)
    {
        DB::table('permissions')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Permission deleted successfully!');
    }
}