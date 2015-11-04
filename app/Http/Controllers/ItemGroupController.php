<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ItemGroup;
use Redirect;
class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $itemgroup = ItemGroup::paginate(50)->setPath('itemgroup');
        //$itemgroup = $itemgroup->sortBy('id');
        return view('itemgroup.index',['itemgroups'=>$itemgroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('itemgroup.newgroupitem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
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
         $itemgroup = ItemGroup::findOrFail($id);
         return view('itemgroup.editgroupitem',['itemgroup'=>$itemgroup]);
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
        $itemgroup = ItemGroup::findOrFail($id);
         $itemgroup->name = $request->name;
          $itemgroup->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $itemgroup = ItemGroup::findOrFail($id);
        $itemgroup->delete();
        return Redirect::back();
    }
}
