<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $connection = 'oracle';
    public  $timestamps = false;
    protected $table = 'SABAY_ITEM_TYPES';
}
