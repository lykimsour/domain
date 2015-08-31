<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OnlineShop;
use Input;
use Redirect;
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
        $onlineshop = new OnlineShop;
        $onlineshop->name = input::get('name');
        $onlineshop->code = input::get('code');
        $onlineshop->detail = input::get('detail');
        $onlineshop->status = input::has('status');
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
        return view('onlineshop.editonlineshop',['onlineshop'=>$onlineshop]);
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
        $onlineshop->name = input::get('name');
        $onlineshop->code = input::get('code');
        $onlineshop->detail = input::get('detail');
        $onlineshop->status = input::has('status');
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
        return Redirect::route('onlineshop');
    }
}
