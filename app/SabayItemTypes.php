<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SabayItemTypes extends Model
{
	protected $connection = 'oracle';
    protected $table = 'SABAY_ITEM_TYPES';
}
