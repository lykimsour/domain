<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
      protected $connection = 'oracle';
      public  $timestamps = false;
    	protected $table = 'SABAY_ITEM_GROUPS';
   
}
