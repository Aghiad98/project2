<?php

namespace App\Http\Controllers;

use App\Models\USer;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =User::whereNot('id',auth()->id())->get();
        $roles= Role::all();
        $permissions = Permission::all();

        return view('admin.index' , compact('users', 'roles', 'permissions'));
    }

    public function createRole(Request $request)
    {
        $request->validate(['name'=>'required|unique:roles']);

        Role::create(['name'=>$request->name]);
        return redirect()->route('admin.index')->with('success','Role created successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assignRole(Request $request , User $user )
    {
        $request -> validate(['role'=>'required|exists:roles,name']);
        if ($user->roles->isNotEmpty()) {
            $user->removeRole($user->roles->first());
        }
        $user->assignRole($request->role);
        return redirect() ->route('admin.index')->with('success','Role assigned successfully');
    }

    /**
     * Display the specified resource.
     */
    public function deleteRole(Role $role)
    {
        $role=Role::findOrFail($role);
        if ($role->name ==='admin') {
            return redirect() ->back()->with('error','The admin role cannot be deleted  ');
        }
        $role->delete();
        return redirect() ->route('admin.dashboard')->with('success','Role deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function assignPermissionToRoles(Request $request , Role $role)
    {
        $request -> validate([ 'Permissions' => 'required|array',
        'Permissions.*' => 'exists:permissions,name',]);
        if ($role->name==='admin') {
            return redirect()->back()->with('errors','The admin permission can\'t be changed. ');
        }
        $role->givePermissionTo($request->Permissions);
        $role->load('Permissions');


        return  redirect()->route('admin.index')->with('success', 'Permission assigned  to role successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function removePermissionFromRoles(Request $request, Role $role)
    {
        $request -> validate(['Permissions' => 'required|array',
            'Permissions.*' => 'exists:permissions,name' ]);
        if ($role->name==='admin') {
            return redirect()->back()->with('error','The admin permission can\'t be removed. ');
        }
        $role->revokePermissionTo($request->Permissions);
        $role->load('Permissions');


        return  redirect()->route('admin.index')->with('success', 'Permission removed  from role successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser (User $user)
    {
        $user->delete();
        return  redirect()->route('admin.index')->with('success', 'user deleted successfully');

    }
}
