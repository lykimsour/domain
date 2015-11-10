<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ItemType;
use Redirect;
use DB;
use App\SabayItemTypes;
use App\Service;
class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getgametype($gametype){
        $gameservice = Service::lists('code','code');
        if(strcasecmp($gametype,'ak')==0){
             $itemtype = ItemType::paginate(env('PAGINATION'))->setPath('itemtype');
        }
       else{ 
         $itemtype = DB::connection(strtolower($gametype))->select(DB::raw("select * from sabay_item_types")); 
       }
        return view('itemtype.index',['itemtypes'=>$itemtype,'gametype'=>$gametype,'gameservice'=>$gameservice]);
    }
    public function index()
    {
         $gameservice = Service::lists('code','code');
        $itemtype = ItemType::paginate(50)->setPath('itemtype');
        return view('itemtype.index',['itemtypes'=>$itemtype,'gameservice'=>$gameservice,'gametype'=>'ak']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gametype)
    {
         $gameservice = Service::lists('code','code');
        return view('itemtype.newitemtype',['gameservice'=>$gameservice,'gametype'=>$gametype]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strcasecmp($request->gametypes,'ak') == 0 ){
            $itemtypeid = ItemType::orderBy('id','DESC')->first();
            $itemtype = new ItemType;
            if(is_null($itemtypeid)){
                $itemtype->id = 1;
            }
            else {
            $itemtype->id = $itemtypeid->id +1;
            }
            $itemtype->name = $request->name;
            $itemtype->save();
        }
        else{
            DB::connection(strtolower($request->gametypes))->statement(DB::raw("insert into sabay_item_types (name) values('".$request->name."')"));
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$gametype)
    {
         if(strcasecmp($gametype, 'ak')==0){
            $itemtype = ItemType::findOrFail($id);
        }
        else{
            $itemtypes = DB::connection(strtolower($gametype))->select(DB::raw("select TOP 1 * from sabay_item_types where id=".$id));
            foreach($itemtypes as $itemtype);
        }
         return view('itemtype.edititemtype',['itemtype'=>$itemtype,'gametype'=>$gametype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$gametype)
    {
        if(strcasecmp($gametype,'ak') == 0 ){
            $itemtype = ItemType::findOrFail($id);
            $itemtype->name = $request->name;
            $itemtype->save();
        }
        else{
            DB::connection(strtolower($gametype))->statement(DB::raw("update sabay_item_types set name ='".$request->name."'where id=".$id));
        }
          return Redirect::route('itemtype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id,$gametype)
    {

        if(strcasecmp($gametype,'ak') == 0 ){
            $itemtype = ItemType::findOrFail($id);
            $itemtype->delete();
        } 
        else{   
            DB::connection(strtolower($gametype))->statement(DB::raw("delete from sabay_item_types where id=".$id));
        }
        return Redirect::back();
    }
}
