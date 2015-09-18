<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\User;
use App\Role;
use App\Permission;
use Redirect;
use Auth;
use Crypt;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request){
    $users = User::All();
    return view('user.index',['users'=>$users]);
    }
  
    public function create(){
        $roles = Role::lists('role_title','id');
        return view('user.newuser',['roles'=>$roles]);
    }

    public function store(Requests\UserRequest $request){
      // dd($request->all());
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('roleid');
        $user->status = $request->has('status');
        $user->save();
        return Redirect::route('users');
    }

    public function edit(){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.edituser',['user'=>$user]);
    }
       // echo $id;
     public function update(Requests\UserRequest $request){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->name = $request->input('name');


        if($user->password != $request->input('password')){

        $user->password = bcrypt($request->input('password'));
        
        }
        $user->email = $request->input('email');
        $user->save();
        return Redirect::route('dashboard.index');
    }

   
    public function block($id){
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->save();
       return Redirect::back();
    }
    public function unblock($id){
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();
       return Redirect::back();
    }

}
