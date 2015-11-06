<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Redirect;
use DB;
use App\ItemGroup;
use App\JxItem;
use Paginator;
use App\Service;
use App\SabayItemTypes;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getgametype($gametype){
        $gameservice = Service::lists('code','code');
        if(strcasecmp($gametype,'ak')==0){
             $item = Item::paginate(env('PAGINATION'))->setPath('item');
       }
       elseif(strcasecmp($gametype,'jx2')==0){ 
        $item = DB::connection('odbc')
        ->select(DB::raw("select *,item.id as id,item.name as name,type.name as typename,groups.name as groupname from sabay_items as item INNER JOIN sabay_item_types as type on item.type_id=type.id INNER JOIN sabay_item_groups as groups on item.group_id = groups.id "));
       }
       else{
        return Redirect::back();
       }
       //return Redirect::route('item');
        return view('item.index',['items'=>$item,'gametype'=>$gametype,'gameservice'=>$gameservice]);
    }
    public function index()
    {
        //$jxitem = DB::connection('odbc')->select(DB::raw("select * from item"));
        $gameservice = Service::lists('code','code');
        $item = Item::paginate(env('PAGINATION'))->setPath('item');
       
        return view('item.index',['items'=>$item,'gametype'=>'ak','gameservice'=>$gameservice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $gameservice = Service::lists('code','code');
        $itemtype = SabayItemTypes::lists('name','id');
        $itemgroup = ItemGroup::lists('name','id');
        return view('item.newitem',['itemgroup'=>$itemgroup,'itemtype'=>$itemtype,'gameservice'=>$gameservice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //strcasecmp($time,"period") ==0

        if(strcasecmp($request->gametypes,'ak') == 0 ){
                $item =  new Item;
                $id = Item::where('id',$request->id)->first();
                if(!is_null($id)){
                    return Redirect::back()->withErrors('ID Already Exist');
                }
                else{
                    //return 'hi';
                        $item->id = $request->id;
                        $item->name = $request->name;
                        $item->type_id = $request->itemtype;
                        $item->group_id = $request->itemgroup;
                        $item->duration = $request->duration;
                        $item->price= $request->price;
                        if(is_null($request->dateadded)){$item->date_added = "";}
                        else{$item->date_added = $request->dateadded;}
                        $item->save();
        }
    }
    elseif(strcasecmp($request->gametypes,'jx2')==0){
        $date = date('Y-m-d H:i:s');
        $date_added = strtotime($request->dateadded);
        $date_added = date('Y-m-d',$date_added);

        $checkid = DB::connection('odbc')->select(DB::raw("select * from sabay_items where ID=".$request->id));
                if(!$checkid){
                        if(!$request->dateadded){$request->dateadded = '0000-00-00';}
                         DB::connection('odbc')->statement(DB::raw("insert into sabay_items (id,name,type_id,duration,price,created_at,updated_at,date_added,group_id) values(".$request->id.",'".$request->name."','".$request->itemtype."',".$request->duration.",".$request->price.",'".$date."','".$date."','".$request->dateadded."',".$request->itemgroup.")"));
                        }
                else{
                    return Redirect::back()->withErrors('ID Already Exist');
                }

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
        $itemtype = SabayItemTypes::lists('name','id');
        $itemgroup = ItemGroup::lists('name','id');
        if(strcasecmp($gametype, 'ak')==0){
            $item = Item::findOrFail($id);
            //dd($item);
        }
        elseif(strcasecmp($gametype, 'jx2')==0){

           $items = DB::connection('odbc')->select(DB::raw("select TOP 1 * from sabay_items where id=".$id));
            foreach($items as $item);
        }
        return view('item.edititem',['item'=>$item,'itemgroup'=>$itemgroup,'gametype'=>$gametype,'itemtype'=>$itemtype]);
        
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

                $item = Item::findOrFail($id);
                $item->id = $request->id;
                $item->name = $request->name;
                $item->type_id = $request->itemtype;
                if(strcasecmp($request->itemtype,"periodic") == 0){
                          $item->duration = $request->duration;
                    }
                else{$item->duration = 0;}
                $item->price = $request->price;
                $item->date_added = $request->dateadded;
                $item->group_id = $request->itemgroup;
                $item->save();
        }
        elseif(strcasecmp($gametype,'jx2')==0){
             $date = date('Y-m-d H:i:s');
             if(!$request->dateadded){$request->dateadded = '0000-00-00';}
             DB::connection('odbc')->statement(DB::raw("update sabay_items set name='".$request->name."',type_id='".$request->itemtype."',duration='".$request->duration."',price='".$request->price."',updated_at='".$date."',date_added='".$request->dateadded."'where id=".$id));
 
        }
        return Redirect::route('item');
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
            $item = Item::findOrFail($id);
            $item->delete();
            }
        elseif(strcasecmp($gametype,'jx2') == 0){
            DB::connection('odbc')->statement(DB::raw("delete from sabay_items where id=".$id));
        }
            return Redirect::back();
    }
}
