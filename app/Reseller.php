<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'reseller';
    public $timestamps = false;

    public function commissiontoresellers()
	{
	  return $this->hasMany('App\CommissionToReseller', 'foreign_key');
	}
}
