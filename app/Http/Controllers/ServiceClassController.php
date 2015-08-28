<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Input;
use App\ServiceClass;
class ServiceClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $serviceclasses = ServiceClass::All();
        return view('serviceclass.index',['serviceclasses'=>$serviceclasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('serviceclass.newserviceclass');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\ServiceClassRequest $request)
    {
        $serviceclass = new ServiceClass;
        $serviceclass->name = input::get('name');
        $serviceclass->commission_rate = input::get('commissionrate');
        $serviceclass->payout_rate = input::get('payoutrate');
        $serviceclass->save();
        return Redirect::route('serviceclass');
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
        $serviceclass = ServiceClass::findOrFail($id);
        return view('serviceclass.editserviceclass',['serviceclass'=>$serviceclass]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\ServiceClassRequest $request)
    {
        $id = input::get('id');
        $serviceclass = ServiceClass::findOrFail($id); 
        $serviceclass->name = input::get('name');
        $serviceclass->commission_rate = input::get('commissionrate');
        $serviceclass->payout_rate = input::get('payoutrate');
        $serviceclass->save();
        return Redirect::route('serviceclass'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $serviceclass = ServiceClass::findOrFail($id); 
        $serviceclass ->delete();
        return Redirect::route('serviceclass'); 
    }
}
