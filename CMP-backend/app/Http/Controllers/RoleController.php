<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return $roles;
    }

       /**
     * Display a permission group of the resource.
     */
    public function create()
    {
    //    $permissionGroup = Permission_group::with('permissions')->get();

    //     return $permissionGroup;
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
        return response()->json(['status'=>200,'data' => $user]);
           
        } else {
            // User is not authenticated
            echo "User not authenticated.";
        }
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->save();
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $role->syncPermissions($permissions);
        return  "Role created with selected permission";
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permissionGroups=PermissionGroup::with('permission')->get();
        $roles= Role::with('permissions')->find($id);
        $rolepermission = [$roles,$permissionGroups];
        return $rolepermission;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $role->syncPermissions($permissions);
        return  "Role updated with selected permission";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return  "Role deleted with selected permission";
    }
}
