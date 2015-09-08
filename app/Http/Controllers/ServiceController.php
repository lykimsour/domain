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
use Form;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $services = Service::paginate(5);
        $services->setPath('service');
        return view('service.index',['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $serviceclasses = ServiceClass::lists('id','id');
        $servicetypes = ServiceType::lists('id','id'); 
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
        //$serviceclassid = input::get('serviceclassid');
        //$servicetypeid =  input::get('servicetypeid');
        $service = new Service;
        $service->code = $request->input('code');
        $service->service_class_id = $request->input('serviceclassid'); 
        $service->service_type_id =$request->input('servicetypeid');
        $service->password = bcrypt($request->input('password'));
        $service->info = $request->input('info');
        //dd($request->all());
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
        $serviceclasses = ServiceClass::lists('id','id');
        $servicetypes = ServiceType::lists('id','id'); 
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
        $id = $request->input('id');
        $service = Service::findOrFail($id);
        $service->code = $request->input('code');
        $service->service_class_id = $request->input('serviceclassid'); 
        $service->service_type_id = $request->input('servicetypeid');
    
        if($service->password != $request->input('password')){
                  $service->password = bcrypt($request->input('password'));
        }
        $service->info = $request->input('info');
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
