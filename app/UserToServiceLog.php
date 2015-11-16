<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToServiceLog extends Model
{
    protected $table = 'transfer_user2service_log';
    
    public function user()
	{
	    return  $this->belongsTo('App\Users');
	}
}
