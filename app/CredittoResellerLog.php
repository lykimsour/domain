<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CredittoResellerLog extends Model
{
    protected $table = 'transfer_credit2reseller_log';
    public function fromreseller(){
		return $this->belongsTo('App\Reseller','from_reseller_id');
	}
	public function toreseller(){
		return $this->belongsTo('App\Reseller','to_reseller_id');
	}
	public function fromuser(){
		return $this->belongsTo('App\Users','from_user_id');
	}
	public function touser(){
		return $this->belongsTo('App\Users','to_user_id');
	}

}
