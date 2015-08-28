<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\User;
use App\Role;
use App\Permission;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function createUser(){
    $users = User::All();
    $roles = Role::All();
    $permissions= Permission::All();
      return view('user.index',['users'=>$users,'roles'=>$roles,'permissions'=>$permissions]);
    }
  


}
