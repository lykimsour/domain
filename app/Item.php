<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   // protected $connection = 'mysql1';
    protected $connection = 'oracle';
    //public $timestamps = false;
    protected $table = 'ITEM';
    public function itemgroup(){
    	return $this->belongsTo('App\ItemGroup','group_id');
    }
}