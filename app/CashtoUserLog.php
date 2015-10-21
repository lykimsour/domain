<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashtoUserLog extends Model
{
    protected $table = 'transfer_cash2user_log';
    public function cashier(){
    	return $this->belongsTo('App\Cashier');
    }
    public function user(){
    	return $this->belongsTo('App\Users');
    }
}
