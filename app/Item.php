<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   // protected $connection = 'mysql1';
    protected $connection = 'oracle';
    //public $timestamps = false;
    protected $table = 'ITEM';
}
