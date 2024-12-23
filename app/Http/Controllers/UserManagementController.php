<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();

        return view('admin.UserManagement.User.user',compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all();

       
        return view('admin.UserManagement.User.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
            'name' => ['required', 'unique:users,name']
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'usertype' => 'admin',
        ]);
        $role = $request->input('role');
        $user->assignRole($role);
        return redirect()->route('userManagement.index')->with('success', 'User Successfull Created');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


     public function destroy(string $id)
{
    $user = User::findOrFail($id);

    if ($user->hasRole('Admin')) {
        return redirect()->route('userManagement.index')->with('error', 'Cannot remove the Admin role from this user');
    }

    foreach ($user->roles as $role) {
        if ($role->name !== 'Admin') {
            $user->removeRole($role->name);
        }
    }

    $user->delete();

    return redirect()->route('userManagement.index')->with('success', 'Roles removed successfully');
}

}
