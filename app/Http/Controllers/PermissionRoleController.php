<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PermissionRole;
use App\User;
use DB;
use App\Permission;
use App\Role;
use Redirect;
class PermissionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::lists('name','id');
        $permissionroles = PermissionRole::All();
        $permissionroles = $permissionroles->sortBy('role_id');
        return view('permissionrole.index',['permissionroles' => $permissionroles,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::All();
        $roles = Role::lists('role_slug','id');
        return view('permissionrole.newpermissionrole',['roles'=>$roles,'permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $permissions = Permission::All();
       
        foreach($permissions as $permission){
    
            if($request->has($permission->permission_slug)){
                    $permissionrole = new PermissionRole;
                    $permissionrole->role_id = $request->input('roleid');
                    $permissionrole->permission_id = $request->input($permission->permission_slug);
                    $permissionrole->save();
           }
        }
        return Redirect::route('permissionrole');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permissionrole = PermissionRole::findOrFail($id);
        $permissions = Permission::lists('permission_title','id');
        $roles = Role::lists('role_slug','id');
        return view('permissionrole.editpermissionrole',['roles'=>$roles,'permissionrole'=>$permissionrole,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
          $permissionrole = PermissionRole::findOrFail($id);
          $permissionrole->role_id = $request->input('roles');
          $permissionrole->permission_id = $request->input('permissions');
          $permissionrole->save();
            return Redirect::route('permissionrole');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permissionrole = PermissionRole::findOrFail($id);
        $permissionrole->delete();
    }
}
