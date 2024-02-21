<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return $users;
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $roles = Role::get();
        $userrole = ["user"=>$users,"role"=>$roles];
        return $userrole;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);
        $user->assignRole($role->name);
        return  "$role->name Assigned to $user->email successfully";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $selecteduser = User::with('roles')->find($id);
        $users = User::get();
        $roles = Role::get();
        return view('admin.assign-user-roles.edit',compact('users','roles','selecteduser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $role = Role::find($request->role_id);
        $user->syncRoles($request->role_);
        return redirect()->back()->with('message', "updated to $user->email successfully");
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
