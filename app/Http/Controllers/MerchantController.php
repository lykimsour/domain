<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Merchant;
use File;
use Redirect;
use App\Service;
class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $merchants = Merchant::All();
        return view('merchant.index',['merchants'=>$merchants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $servicecode = Service::lists('code','code');
        return view('merchant.newmerchant',['servicecode'=>$servicecode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\MerchantRequest $request)
    {
       try{


       if ($request->hasFile('image'))
         {
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/logo/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/logo/'. $filename;
           
            
        }
        else{
            $image = 'null';
        }
        $merchant = new Merchant;
        $merchant->name = $request->input('name');
        $merchant->email = $request->input('email');
        $merchant->service_code = $request->input('servicecode');
        $merchant->password = $request->input('password');
        $merchant->coin = $request->input('coin');
        $merchant->currency = $request->input('currency');
        $merchant->status = $request->has('status');
        $merchant->commission = $request->input('comission');
        $logo = array('logo'=>$image);
        $logo = json_encode($logo, JSON_UNESCAPED_SLASHES);
        $merchant->logo =  $logo;
        $merchant->save();
        return Redirect::route('merchant');
    }
    catch(\Illuminate\Database\QueryException $e){
          return Redirect::back()->withErrors("service_code Can't be double in Merchant Table");
    }
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
         $servicecode = Service::lists('code','code');

        $merchant = Merchant::findOrFail($id);
        $logo = json_decode($merchant->logo);
        return view('merchant.editmerchant',['merchant'=>$merchant,'logo'=>$logo,'servicecode'=>$servicecode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\MerchantRequest $request, $id)
    {
        $merchant = Merchant::findOrFail($id);
        $logo = json_decode($merchant->logo);
        try{
          if ($request->hasFile('image'))
         {
            if($logo->logo !='null'){
                $filename = public_path().'/'.$logo->logo;
                if (File::exists($filename)) {
                File::delete($filename);
                }
            }
             
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/logo/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/logo/'. $filename; 
             $logo = array('logo'=>$image);
             $logo = json_encode($logo, JSON_UNESCAPED_SLASHES);
        }
        else{
            $logo = $merchant->logo;
        }
        $merchant->name = $request->input('name');
        $merchant->email = $request->input('email');
        $merchant->service_code = $request->input('servicecode');
        if($merchant->password != $request->input('password')){
        $merchant->password = bcrypt($request->input('password'));
        }
      
        $merchant->coin = $request->input('coin');
        $merchant->currency = $request->input('currency');
        $merchant->status = $request->has('status');
        $merchant->commission = $request->input('comission');
        $merchant->logo = $logo;
        $merchant->save();
         return Redirect::route('merchant');
     }
      catch(\Illuminate\Database\QueryException $e){
       
          return Redirect::back()->withErrors("service_code Can't be double in Merchant Table");
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $merchant = Merchant::findOrFail($id);
        $logo = json_decode($merchant->logo);
        if($logo->logo !='null'){
                $filename = public_path().'/'.$logo->logo;
                if (File::exists($filename)) {
                File::delete($filename);
                }

        }
        $merchant->delete();
        return Redirect::back();
    }
}
