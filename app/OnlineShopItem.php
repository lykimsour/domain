<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineShopItem extends Model
{
    protected $table = 'online_shop_items';
    public $timestamps = false;
    public function onlineshop(){
    	return $this->belongsToMany('App/onlineshop');
    }
}
