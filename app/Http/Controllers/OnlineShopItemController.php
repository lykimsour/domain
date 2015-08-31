<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OnlineShopItem;
use App\OnlineShop;
use Input;
use Redirect;
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
        $onlineshopitem = new OnlineShopItem;
        $onlineshopitem->online_shop_code = input::get('onlineshops');
        $onlineshopitem->item = input::get('item');
        $onlineshopitem->ordering = input::get('ordering');
        $onlineshopitem->status = input::has('status');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
