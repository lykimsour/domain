<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use Redirect;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::All();
        return view('roles.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.newrole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\RoleRequest $request)
    {
        $role = new Role;
        $role->role_title = $request->input('roletitle');
        $role->role_slug = $request->input('roleslug');
        $role->save();
        return Redirect::route('role');
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
        $role = Role::findOrFail($id);
        
        return view('roles.editrole',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->role_title = $request->input('roletitle');
        $role->role_slug = $request->input('roleslug');
        $role->save();
        return Redirect::route('role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return Redirect::back();
    }
}
