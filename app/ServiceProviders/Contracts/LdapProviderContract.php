<?php

namespace App\ServiceProviders\Contracts;

Interface LdapProviderContract {
	public function login($username, $password);
}

?>