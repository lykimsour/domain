<?php 
namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\Requests\Auth\RegisterRequest;
use App\DB\User\Traits\UserACL;
use App\DB\User\Traits\UserAccessors;
use App\DB\User\Traits\UserQueryScopes;
use App\DB\User\Traits\UserRelationShips;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Cashier extends Model {

  	protected $table = 'cashier';

	public function commissiontocashiers()
	{
	  return $this->hasMany('App\CommissionToCashier', 'foreign_key');
	}
	

    
	public function cashiertoreseller()
	{
		$this->hasMany('App\CashierToReseller');
	}

}