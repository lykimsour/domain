<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Redirect;
use DB;
use App\ItemGroup;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $item = Item::paginate(env('PAGINATION'))->setPath('item');
        return view('item.index',['items'=>$item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $itemgroup = ItemGroup::lists('name','id');
        return view('item.newitem',['itemgroup'=>$itemgroup]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $item =  new Item;
        $id = Item::where('id',$request->id)->first();
        if(!is_null($id)){
            return Redirect::back()->withErrors('ID Already Exist');
        }
        else{
                $item->id = $request->id;
                $item->name = $request->name;
                $item->type = $request->itemtype;
                if(strcasecmp($request->itemtype,"periodic") == 0){
                    $item->duration = $request->duration;
                    }
                    else{ $item->duration = '' ;}
                $item->price= $request->price;
                    if(is_null($request->dateadded)){$item->date_added = "";}
                    else{$item->date_added = $request->dateadded;}
                $item->group_id = $request->itemgroup;
                $item->save();
        return Redirect::back();
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
        $itemgroup = ItemGroup::lists('name','id');
        $item = Item::findOrFail($id);
        return view('item.edititem',['item'=>$item,'itemgroup'=>$itemgroup]);
        
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

        $item = Item::findOrFail($id);
        $item->id = $request->id;
        $item->name = $request->name;
        $item->type = $request->itemtype;
        if(strcasecmp($request->itemtype,"periodic") == 0){
        $item->duration = $request->duration;
        }
        else{$item->duration = '';}
        $item->price = $request->price;
        $item->date_added = $request->dateadded;
        $item->group_id = $request->itemgroup;
        $item->save();
        return Redirect::route('item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return Redirect::back();
    }
}
