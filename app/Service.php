<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    public $timestamps = false;
    
  public function commissiontocashiers()
  {
    return $this->hasMany('App\CommissionToCashier', 'foreign_key');
  }

  public function servicetype()
  {
    return $this->belongsTo('App\ServiceType');
  }

  public function commissiontoresellers()
  {
    return $this->hasMany('App\CommissionToReseller', 'foreign_key');
  }
}
