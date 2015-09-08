<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Input;
use Validator;
use App\Cashier;
use Redirect;
class CashierController extends Controller
{
    public function showCashier(){
      $cashiers = Cashier::paginate(5);
      $cashiers->setPath('cashier');
      return view('cashier.index',['cashiers'=>$cashiers]);
    }

    public function getCashier(){
      return view('cashier.newcashier');
    }

    public function postCashier(Requests\CreateCashierRequest $request){
      $cashier = new Cashier; 
      $cashier->name = $request->input('name');
      $cashier->username = $request->input('username');
      $cashier->password = bcrypt($request->input('password'));
      $cashier->commission_rate = $request->input('commission');  
      $cashier->status = $request->has('status');
      $cashier->only2service = false;
      $cashier->pay_bonus = false;
      $cashier->bonus_balance = 0;
      $cashier->save();
      return Redirect::route('showcashier');
    }

    public function geteditCashier($id){
      $cashiers = Cashier::findOrFail($id);
      return view('cashier.editcashier',['cashiers'=>$cashiers]);
    }
    public function puteditCashier(Requests\EditCashierRequest $request){
      $id = input::get('id');
      $cashier = Cashier::findOrFail($id);
      $cashier->name = $request->input('name');
      $cashier->username = $request->input('username');
      $cashier->commission_rate = $request->input('commission');  
      $cashier->only2service = false;
      $cashier->pay_bonus = false;
      $cashier->bonus_balance = 0;
      $cashier->status = $request->has('status');
      if($cashier->password != $request->input('password')){
        $cashier->password = bcrypt($request->input('password'));
      }
      $cashier->commission_rate = $request->input('commission');  
      $cashier->save();
      return Redirect::route('showcashier');
    }

    public function destroy($id){
      $cashier = Cashier::findOrFail($id);
      $cashier->delete();
      return Redirect::back();
    }

}
