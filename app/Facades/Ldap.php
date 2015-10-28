<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Ldap extends Facade {
	protected static function getFacadeAccessor() {
		return 'App\ServiceProviders\Contracts\LdapProviderContract';
	}
}
