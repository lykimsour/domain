<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\ServiceProviders\LdapProvider;

/**
 *
 * Service provider for LdapLaravelProvider - extends Auth system registering ldap auth system
 * @package RiCi12\LdapLaravelProvider\ServiceProvider
 */

class LdapServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\ServiceProviders\Contracts\LdapProviderContract', function(){

            return new LdapProvider();

        }); 
    }

    public function provides()
    {
        return ['App\ServiceProviders\Contracts\LdapProviderContract'];
    }
}