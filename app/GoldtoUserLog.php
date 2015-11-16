<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoldtoUserLog extends Model
{
    protected $table = 'transfer_gold2user_log';
    public function cashier(){
    	return $this->belongsTo('App\Cashier','cashier_id');
    } 
    public function user(){
    	return $this->belongsTo('App\Users','user_id');
    }
}
