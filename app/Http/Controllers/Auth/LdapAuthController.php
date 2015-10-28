<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LdapUser;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\ServiceProviders\Contracts\LdapProviderContract;
use App\Facades\Ldap;

class LdapAuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    use AuthenticatesAndRegistersUsers;
    
    public function postLogin(Request $request)
    {
      $username = $request->username;
      $password = $request->password;
  
      return Ldap::login($username, $password);
    }

    public function getLogout()
    {
      Auth::logout();
      return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
     
}
