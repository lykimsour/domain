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

   public function deleteOtherUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::back();
   }

    public function editOtherUser($id){
        $user = User::findOrFail($id);
        $roles = Role::lists('role_title','id');
        return view('user.editotheruser',['user'=>$user,'roles'=>$roles]);
   }


    public function updateOtherUser(Request $request,$id){
        $user = User::findOrFail($id);
        $this->validate($request, [

        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:adminusers,email,'.$user->id,
        'password' => 'required|confirmed|min:6'
        
        ]);

        $user->name = $request->input('name');
        if($user->password != $request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }

        $user->email = $request->input('email');
        $user->role_id = $request->input('roleid');
        $user->save();
        return Redirect::route('users');
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
