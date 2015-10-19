<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    public $timestamps = false; 

    public function roles(){
    	return $this->belongsTo('App\Role','role_id');
    }
     public function permissions()
    {
        return $this->belongsTo('App\Permission','permission_id');
    }
}
