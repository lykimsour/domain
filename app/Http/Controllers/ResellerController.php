<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reseller;
use App\ResellerRequest;
use Redirect;
use Carbon\Carbon;
class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function requesttoken($id){
      
        $resellerrequest = new ResellerRequest;
        $resellerrequest->token = str_random(64);
        $resellerrequest->reseller_id = $id;
        $resellerrequest->datetime = Carbon::now();
        $resellerrequest->save(); 
        return Redirect::back();
    }
    public function index()
    {
        $resellers = Reseller::where('status','=','1')->paginate(50);
        $resellers->setPath('reseller');
        return view('resellers.index',['resellers'=>$resellers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
