<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToMerchant extends Model
{
    protected $table = 'transfer_user2merchant_log';

    public function user()
	{
	  return $this->belongsTo('App\Users');
	}
}
