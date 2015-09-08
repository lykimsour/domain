<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceClass extends Model
{
    protected $table = 'service_class';
    public $timestamps = false;
    public function servicetype(){
    	return $this->belongsToMany('App\servicetype');
    }
}
