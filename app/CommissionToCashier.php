<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionToCashier extends Model
{
    protected $table = 'transfer_com2cashier_log';

    public function cashier()
    {
       return  $this->belongsTo('App\Cashier');
    }

    public function user()
    {
      return  $this->belongsTo('App\Users');
    }

    public function service()
    {
      return  $this->belongsTo('App\Service');
    }
   
}
