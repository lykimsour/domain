<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'reseller';
    public $timestamps = false;
   public function cashiertoreseller(){
		$this->hasMany('App\CashierToReseller');
	}
}
