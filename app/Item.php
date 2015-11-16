<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   // protected $connection = 'mysql1';
    protected $connection = 'oracle';
    //public $timestamps = false;
    protected $table = 'SABAY_ITEMS';
    public function itemgroup(){
    	return $this->belongsTo('App\ItemGroup','group_id');
    }
     public function itemtype(){
    	return $this->belongsTo('App\SabayItemTypes','type_id');
    }
}
