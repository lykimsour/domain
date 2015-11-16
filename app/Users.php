<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = "user";
  
  public function commissiontocashiers()
  {
    return $this->hasMany('App\CommissionToCashier', 'foreign_key');
  }

  public function commissiontoresellers()
  {
    return $this->hasMany('App\CommissionToReseller', 'foreign_key');
  }

  public function usertoservicelogs()
  {
    return $this->hasMany('App\UserToServiceLog', 'foreign_key');
  }

  public function usertoshoplogs()
  {
    return $this->hasMany('App\UserToShopLog', 'foreign_key');
  }

  public function users()
  {
    return $this->hasMany('App\UserToMerchant', 'foreign_key');
  }
  public function cashtouser()
  {
    return $this->hasMany('App\CashtoUserLog');
  }
  public function credittouser()
  {
    return $this->hasMany('App\CredittoUserLog');
  }
}
