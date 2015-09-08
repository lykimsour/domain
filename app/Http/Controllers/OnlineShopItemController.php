<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OnlineShopItem;
use App\OnlineShop;
use Input;
use Redirect;
use rtrim;
use File;
class OnlineShopItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $onlineshopitems = OnlineShopItem::paginate(5);
        $onlineshopitems->setPath('onlineshopitem');
        return view('onlineshopitem.index',['onlineshopitems'=>$onlineshopitems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $onlineshops = OnlineShop::lists('code','code');
        return view('onlineshopitem.newonlineshopitem',['onlineshops'=>$onlineshops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Requests\OnlineShopItemRequest $request)
    {
       
        if ($request->hasFile('image'))
         {
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/item-image/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/item-image/'. $filename;
            
        }
        else{
            $image = 'null';
        }
        $onlineshopitem = new OnlineShopItem;
        $onlineshopitem->online_shop_code = $request->input('onlineshops');
        $name = $request->input('name');
        $sku = $request->input('sku');
        $currency = $request->input('currency');
        $value = $request->input('value');
        $max = $request->input('max');
        $arrayitem = array('name'=>$name,'sku'=>$sku,'currency'=>$currency,'value'=>$value,'max'=>$max,'image'=>$image);
        $arrayitem = json_encode($arrayitem, JSON_UNESCAPED_SLASHES);
        $onlineshopitem->item = $arrayitem;
        $onlineshopitem->ordering = $request->input('ordering');
        $onlineshopitem->status = $request->has('status');
        $onlineshopitem->save();
        return Redirect::route('onlineshopitem');
        
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
        $onlineshops = OnlineShop::lists('code','code');
        $onlineshopitem = OnlineShopItem::findOrFail($id);

        $arrayitem = json_decode($onlineshopitem->item);
       
        return view('onlineshopitem.editonlineshopitem',['onlineshopitem'=>$onlineshopitem,'onlineshops'=>$onlineshops,'arrayitem'=>$arrayitem,'arrayitem'=>$arrayitem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\OnlineShopItemRequest $request, $id)
    {

        $onlineshopitem = OnlineShopItem::findOrFail($id);
        $arrayitem = json_decode($onlineshopitem->item);
         if ($request->hasFile('image'))
         {
            if($arrayitem->image !='null'){
                $filename = public_path().'/'.$arrayitem->image;
                File::delete($filename);
            }
             
             $image = $request->file('image');
             $destinationPath = public_path().'/uploads/item-image/';
             $filename = time().'_'.$image->getClientOriginalName();
             $uploaded = $image->move($destinationPath, $filename);
             $image = 'uploads/item-image/'. $filename;  
        }
        else{
            $image = $arrayitem->image;
        }
        
        $onlineshopitem->online_shop_code = $request->input('onlineshops');
        $name = $request->input('name');
        $sku = $request->input('sku');
        $currency = $request->input('currency');
        $value = $request->input('value');
        $max = $request->input('max');
        $arrayitem = array('name'=>$name,'sku'=>$sku,'currency'=>$currency,'value'=>$value,'max'=>$max,'image'=>$image);
        $arrayitem = json_encode($arrayitem, JSON_UNESCAPED_SLASHES);
        $onlineshopitem->item = $arrayitem;
        $onlineshopitem->ordering = $request->input('ordering');
        $onlineshopitem->status = $request->has('status');
        $onlineshopitem->save();

        return Redirect::route('onlineshopitem');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //dd(date('Y-m-d H:i:s'));
        $onlineshopitem = OnlineShopItem::findOrFail($id);
        $arrayitem = json_decode($onlineshopitem->item);
      
        $filename = public_path().'/'.$arrayitem->image;
        if (File::exists($filename)) {
            File::delete($filename);
        } 
        $onlineshopitem->delete();
        return Redirect::back();
    }
}
