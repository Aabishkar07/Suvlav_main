<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('admin.UserManagement.Role.role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permission = Permission::all();
        return view('admin.UserManagement.Role.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = Role::create(['name' => $request->name]);
      
        $permission = $request->permission;
        
        $role->givePermissionTo($permission);
      
        return redirect()->route('userRole.index')->with('success', 'Role Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($roleId)
    {
        //


        $role = Role::where('id', $roleId)->first();
        
        if (!$role) {
            abort(404, 'Role not found');
        }
        
      
   


        $permissions = Permission::select('parent', 'name as permission_name', 'guard_name')
            ->distinct()
            ->get();


           


            
            $oldPermissions = $role->permissions->pluck('name')->toArray();
            
          


        return view('admin.UserManagement.Role.edit', compact('role', 'permissions', 'oldPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $role)
    {
        //
        $role = Role::where('id', $role)->first();
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role->update(['name' => $request->name]);
        $permissions = $request->input('permissions', []); // Get permissions, default to an empty array
        $role->syncPermissions($permissions);

        return redirect()->route('userRole.index')->with('success', 'Role Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        //
        $role = Role::find($roleId);

        if (!$role) {
            return redirect()->route('userRole.index')->with('error', 'Role not found');
        }

        if ($role->name === 'Admin') {
            return redirect()->route('userRole.index')->with('error', 'Cannot delete the Admin role');
        }

        $role->delete();

        return redirect()->route('userRole.index')->with('success', 'Role Deleted Successfully');

    }
}
