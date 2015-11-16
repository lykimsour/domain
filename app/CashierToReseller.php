<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashierToReseller extends Model
{
   	protected $table = 'transfer_cash2reseller_log';
   	public function cashier(){
   		return $this->belongsTo('App\Cashier');
   	}
   	public function reseller(){
   		return $this->belongsTo('App\Reseller');
   	}
}
