<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionToReseller extends Model
{
  protected $table = 'transfer_com2reseller_log';
  
  public function user()
  {
    return  $this->belongsTo('App\Users');
  }

  public function reseller()
  {
    return  $this->belongsTo('App\Reseller');
  }

  public function service()
  {
    return  $this->belongsTo('App\Service');
  }
}
