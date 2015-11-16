<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineShop extends Model
{
    protected $table = 'online_shops';
    public $timestamps = false;
    public function onlineshopitems(){
    	return $this->hasMany('App/OnlineShopItem');
    }
}
