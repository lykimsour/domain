<?php
namespace App\ServiceProviders;

use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\LdapUser;
use App\User;
use App\ServiceProviders\Contracts\LdapProviderContract;
use Session;
class LdapProvider implements LdapProviderContract
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $ldaprdn, $ldapconn, $bind;
    use AuthenticatesAndRegistersUsers;

    public function __construct(){
      // ldap rdn or dn
      $this->ldaprdn  = env("LDAP_BASE_DN"); 
      // connect to ldap server
      $this->ldapconn = ldap_connect(env("LDAP_HOST")) or die("Could not connect to LDAP server.");
      $this->bind     = ldap_bind($this->ldapconn);
    }

    public function login($username, $password)
    {     
      // Get user from database
      $user = User::where('name', $username)->first();
 
      if(count($user) == 0)
        return redirect($this->loginPath())
                ->withErrors([$this->getFailedLoginMessage()]);
      else
        if($user->status == 0)
          return redirect($this->loginPath())
                ->withErrors('Your Account Blocked By Admin');
      // Get user from Ldap if email user database equal email ldap
      $get_user = ldap_search($this->ldapconn, $this->ldaprdn, "uid=".$user->name);
      $info     = @ldap_get_entries($this->ldapconn, $get_user);

      // check if email and password not match will be return
      if($info['count'] == 0)
        return redirect($this->loginPath())
                ->withErrors([$this->getFailedLoginMessage()]);

      $get_ldapuser = @ldap_bind($this->ldapconn, $info[0]['dn'], $password);

      if($get_ldapuser) {   
        $ldap_user = new LdapUser;
        $ldap_user->id        = $user->id;
        $ldap_user->givenname = $info[0]['givenname'][0];
        $ldap_user->name      = $info[0]['displayname'][0];
        $ldap_user->mail      = $info[0]['mail'][0];
        $ldap_user->photo     = $info[0]['jpegphoto'][0];
        $ldap_user->manager   = $info[0]['manager'][0];
 
        Auth::login($ldap_user); 
        Session::set('username', $ldap_user->name);
        if (Auth::check()) 
          return redirect('/');      
      }
    }
}
