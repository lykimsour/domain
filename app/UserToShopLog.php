<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToShopLog extends Model
{
    protected $table = 'transfer_user2shop_log';  
    public function user()
	{
	    return  $this->belongsTo('App\Users');
	}
}
