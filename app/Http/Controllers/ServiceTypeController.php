<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ServiceType;
use Input;
use Redirect;
class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $servicetypes = ServiceType::All(); 
        return view('servicetype.index',['servicetypes'=>$servicetypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('servicetype.newservicetype');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\ServiceTypeRequest $request)
    {
        $servicetype = new ServiceType;
        $servicetype->name = $request->input('name');
        $servicetype->save();
        return Redirect::route('servicetype');
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
        $servicetype = ServiceType::findOrFail($id);
        return view('servicetype.editservicetype',['servicetype'=>$servicetype]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\ServiceTypeRequest $request)
    {
        $id = input::get('id');
        $servicetype = ServiceType::findOrFail($id);
        $servicetype->name = $request->input('name');
        $servicetype->save();
       return Redirect::route('servicetype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
         $servicetype = ServiceType::findOrFail($id);
         $servicetype->delete();
          return Redirect::route('servicetype');
    }
}
