<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CredittoUserLog extends Model
{  
	protected $table = 'transfer_credit2user_log';
	public function reseller(){
		return $this->belongsTo('App\Reseller','reseller_id');
	}
	public function fromuser(){
		return $this->belongsTo('App\Users','from_user_id');
	}
	public function touser(){
		return $this->belongsTo('App\Users','user_id');
	}
}
