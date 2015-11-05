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
        /*$id = 1;
        $results = DB::connection('odbc')->select(DB::raw("select * from item02 where itemguid=".$id));
        if(!$results){
            return 'jk';
        }
        else{
            
            foreach($results as $r){
                return $r->itemguid;
            }
        }
        //$r = DB::connection('odbc')->table('item02')->get(); 
        dd($results);
      // $jxitems = JxItem::All();
        //dd($jxitems);*/
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
        //strcasecmp($time,"period") ==0
        if(strcasecmp($request->gametypes,'ak') == 0 ){
                $item =  new Item;
                $id = Item::where('id',$request->id)->first();
                if(!is_null($id)){
                    return Redirect::back()->withErrors('ID Already Exist');
                }
                else{
                     $item->id = $request->id;
                        $item->name = $request->name;
                        $item->type = $request->itemtype;
                        $item->duration = $request->duration;
                        $item->price= $request->price;
                         if(is_null($request->dateadded)){$item->date_added = "";}
                            else{$item->date_added = $request->dateadded;}
                        $item->group_id = $request->itemgroup;
                        $item->save();
        }
    }
    elseif(strcasecmp($request->gametypes,'jx2')==0){
        $date = date('Y-m-d H:i:s');
        $date_added = strtotime($request->dateadded);
        $date_added = date('Y-m-d',$date_added);

        $checkid = DB::connection('odbc')->select(DB::raw("select * from item where ID=".$request->id));
                if(!$checkid){
                        if(!$request->dateadded){$request->dateadded = '0000-00-00';}
                         DB::connection('odbc')->statement(DB::raw("insert into item (ID,Name,Type,Duration,Price,created_at,updated_at,date_added,group_id) values(".$request->id.",'".$request->name."','".$request->itemtype."',".$request->duration.",".$request->price.",'".$date."','".$date."','".$request->dateadded."',".$request->itemgroup.")"));
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
        if(strcasecmp($request->gametypes,'ak') == 0 ){
                $item = Item::findOrFail($id);
                $item->id = $request->id;
                $item->name = $request->name;
                $item->type = $request->itemtype;
                if(strcasecmp($request->itemtype,"periodic") == 0){
                          $item->duration = $request->duration;
                    }
                else{$item->duration = 0;}
                $item->price = $request->price;
                $item->date_added = $request->dateadded;
                $item->group_id = $request->itemgroup;
                $item->save();
        }
        elseif(strcasecmp($request->gametypes,'jx2')==0){

        }
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
