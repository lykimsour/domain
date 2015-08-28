<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ServiceClass;
use App\ServiceType;
use App\Service;
use Input;
use Redirect;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $services = Service::All();
        return view('service.index',['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $serviceclasses = ServiceClass::All();
        $servicetypes = ServiceType::All(); 
        return view('service.newservice',['serviceclasses'=>$serviceclasses,'servicetypes'=>$servicetypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\NewServiceRequest $request)
    {
        $service = new Service;
        $service->code = input::get('code');
        $service->service_class_id = input::get('serviceclassid'); 
        $service->service_type_id = input::get('servicetypeid');
        $service->password = bcrypt(input::get('password'));
        $service->info = input::get('info');
        $service->save();
        return Redirect::route('service');
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
        $serviceclasses = ServiceClass::All();
        $servicetypes = ServiceType::All(); 
        $service = Service::findOrFail($id);
        return view('service.editservice',['service'=>$service,'serviceclasses'=>$serviceclasses,'servicetypes'=>$servicetypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\NewServiceRequest $request)
    {
        $id=input::get('id');
        $service = Service::findOrFail($id);
        $service->code = input::get('code');
        $service->service_class_id = input::get('serviceclassid'); 
        $service->service_type_id = input::get('servicetypeid');
    
        if($service->password != input::get('password')){
                  $service->password = bcrypt(input::get('password'));
        }
        $service->info = input::get('info');
        $service->save();
        return Redirect::route('service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return Redirect::route('service');
    }
}
