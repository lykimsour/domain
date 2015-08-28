<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function gettest(Request $request)
    {
        //return $request->id;
        //return 'hi';
        return view('dashboard.index',['re'=>$request]);
        //echo 'fgf';
        //return $request->url();
        //return 'you are admin';
    }
    public function getRegister(){
        return view('auth.register');
    }
    public function languageChoose($dil)
  {
    session(['locale' => $dil]);
    return redirect()->back();
  }


}
