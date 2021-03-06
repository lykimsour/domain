<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use Redirect;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::All();
      
        return view('permissions.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissions.newpermission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\PermissionRequest $request)
    {
        $permission = new Permission;
        $permission->permission_title = $request->input('permissiontitle');
        $permission->permission_slug = $request->input('permissionslug');
        $permission->save();
        return Redirect::route('permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
            $permission = Permission::findOrFail($id);
          
            return view('permissions.editpermission',['permission'=>$permission]);
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
            $permission = Permission::findOrFail($id);
            $permission->permission_title = $request->input('permissiontitle');
            $permission->permission_slug = $request->input('permissionslug');
            $permission->save();
        return Redirect::route('permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
