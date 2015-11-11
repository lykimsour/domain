<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\GameUpdate;
use Redirect;
use Carbon\Carbon;
class GameUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameservice = Service::lists('code','code');
        $gameupdate = GameUpdate::paginate(50);
        return view('gameupdate.index',['gameservice'=>$gameservice,'gametype'=>'ak','gameupdates'=>$gameupdate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gametype)
    {
        $gameservice = Service::lists('code','id');
        return view('gameupdate.newgameupdate',['gameservice'=>$gameservice,'gametype'=>$gametype]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gameupdate = new GameUpdate;
        $gameupdate->service_id = $request->gametypes;
        $gameupdate->date = Carbon::parse($request->updatedate)->format('Y/m/d '.date('H:i:s'));
        $gameupdate->save();
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
         $gameservice = Service::lists('code','id');
         $gameupdate = GameUpdate::findOrFail($id);
        return view('gameupdate.editgameupdate',['gameupdate'=>$gameupdate,'gametype'=>$gametype,'gameservice'=>$gameservice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gameupdate = GameUpdate::findOrFail($id);
        $gameupdate->service_id = $request->gametypes;
        $gameupdate->date = Carbon::parse($request->updatedate)->format('Y/m/d '.date('H:i:s'));
        $gameupdate->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gameupdate = GameUpdate::findOrFail($id);
        $gameupdate->delete();
        return Redirect::back();
    }
}
