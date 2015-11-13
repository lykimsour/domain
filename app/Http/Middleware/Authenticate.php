<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use App\User;
use Auth;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {

        $this->auth = $auth;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        //else{
            if ($this->auth->guest()) {
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
            } else {
                   return redirect()->guest('auth/login');
            }

            }
        //}
        return $next($request);
    }

     protected function getBlockedsms(){
          return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'You are blocked by Admin.';
    }
     public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'username';
    }
}
