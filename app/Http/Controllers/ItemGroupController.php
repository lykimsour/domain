<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ItemGroup;
use Redirect;
use DB;
use App\SabayItemTypes;
use App\Service;
class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function getgametype($gametype){
        $gameservice = Service::lists('code','code');
        if(strcasecmp($gametype,'ak')==0){
             $itemgroup = ItemGroup::paginate(env('PAGINATION'))->setPath('itemgroup');
        }
       else{ 
         $itemgroup = DB::connection(strtolower($gametype))->select(DB::raw("select * from sabay_item_groups")); 
       }
        return view('itemgroup.index',['itemgroups'=>$itemgroup,'gametype'=>$gametype,'gameservice'=>$gameservice]);
    }
    public function index()
    {
        $gameservice = Service::lists('code','code');
        $itemgroup = ItemGroup::paginate(50)->setPath('itemgroup');
        return view('itemgroup.index',['itemgroups'=>$itemgroup,'gameservice'=>$gameservice,'gametype'=>'ak']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($gametype)
    {
        $gameservice = Service::lists('code','code');
        //if(strcasecmp($gametype,'ak') == 0 ){
            //$itemgroup = ItemGroup::lists('name','id');
        //}
        return view('itemgroup.newgroupitem',['gameservice'=>$gameservice,'gametype'=>$gametype]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(strcasecmp($request->gametypes,'ak') == 0 ){
            $itemgroupid = ItemGroup::orderBy('id','DESC')->first();
            $itemgroup = new ItemGroup;
            if(is_null($itemgroupid)){
                $itemgroup->id = 1;
            }
            else {
            $itemgroup->id = $itemgroupid->id +1;
            }
            $itemgroup->name = $request->name;
            $itemgroup->save();
        }
        else{
            DB::connection(strtolower($request->gametypes))->statement(DB::raw("insert into sabay_item_groups (name) values('".$request->name."')"));
        }
        return Redirect::back();
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
    public function edit($id,$gametype)
    {
         
         if(strcasecmp($gametype, 'ak')==0){
            $itemgroup = ItemGroup::findOrFail($id);
        }
        else{
            $itemgroups = DB::connection(strtolower($gametype))->select(DB::raw("select TOP 1 * from sabay_item_groups where id=".$id));
            foreach($itemgroups as $itemgroup);
        }
         return view('itemgroup.editgroupitem',['itemgroup'=>$itemgroup,'gametype'=>$gametype]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id,$gametype)
    {
        if(strcasecmp($gametype,'ak') == 0 ){
            $itemgroup = ItemGroup::findOrFail($id);
            $itemgroup->name = $request->name;
            $itemgroup->save();
        }
        else{
            
            DB::connection(strtolower($gametype))->statement(DB::raw("update sabay_item_groups set name ='".$request->name."'where id=".$id));
        }
          return Redirect::route('itemgroup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id,$gametype)
    {
        if(strcasecmp($gametype,'ak') == 0 ){
            $itemgroup = ItemGroup::findOrFail($id);
            $itemgroup->delete();
        } 
        else{   
            DB::connection(strtolower($gametype))->statement(DB::raw("delete from sabay_item_groups where id=".$id));
        }
        return Redirect::back();
    }
}
