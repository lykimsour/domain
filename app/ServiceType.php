<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_type';
    public $timestamps = false;
    public function serviceclass(){
    	return $this->belongsToMany('App\serviceclass');
    }
}
