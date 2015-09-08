<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OnlineShop;
use Input;
use Redirect;
use File;
class OnlineShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $onlineshops = OnlineShop::paginate(5);
        $onlineshops->setPath('onlineshop');
        return view('onlineshop.index',['onlineshops'=>$onlineshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('onlineshop.newonlineshop');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\OnlineShopRequest $request)
    {
        if ($request->hasFile('image'))
         {
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/icons/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/icons/'. $filename;
            
        }
        else{
            $image = 'null';
        }
        $onlineshop = new OnlineShop;
        $onlineshop->name = $request->input('name');
        $onlineshop->code = $request->input('code');
        $description = $request->input('description');
        $helpnote = $request->input('helpnote');
        $specialnote = $request->input('specialnote');
        $arraydetail = array('icon'=>$image,'description'=>$description,'help_note'=>$helpnote,'special_note'=>$specialnote);
        $arraydetail = json_encode($arraydetail, JSON_UNESCAPED_SLASHES);
        $onlineshop->detail =  $arraydetail;
        $onlineshop->status = $request->has('status');
        $onlineshop->save();
        return Redirect::route('onlineshop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $onlineshop = OnlineShop::findOrFail($id);
        $arraydetail = json_decode($onlineshop->detail);
        return view('onlineshop.editonlineshop',['onlineshop'=>$onlineshop,'arraydetail'=>$arraydetail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\OnlineShopRequest $request)
    {
        $id = input::get('id');
        $onlineshop = OnlineShop::findOrFail($id);
        $arraydetail = json_decode($onlineshop->detail);

          if ($request->hasFile('image'))
         {
            if($arraydetail->icon !='null'){
                $filename = public_path().'/'.$arraydetail->icon;
                File::delete($filename);
            }
             
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/icons/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/icons/'. $filename; 
        }
        else{
            $image = $arraydetail->icon;
        }
        $onlineshop->name = $request->input('name');
        $onlineshop->code = $request->input('code');
        $description = $request->input('description');
        $helpnote = $request->input('helpnote');
        $specialnote = $request->input('specialnote');
        $arraydetail = array('icon'=>$image,'description'=>$description,'help_note'=>$helpnote,'special_note'=>$specialnote);
        $arraydetail = json_encode($arraydetail, JSON_UNESCAPED_SLASHES);
        $onlineshop->detail =  $arraydetail;
        $onlineshop->status = $request->has('status');
        $onlineshop->save();
        return Redirect::route('onlineshop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $onlineshop = OnlineShop::findOrFail($id);
        $onlineshop->delete();
        return Redirect::back();
    }
}
