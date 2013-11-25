<?php

namespace ProfitPress\Security;

use Phalcon\Mvc\User\Component;

class Authenticator extends Component
{


	public static function generatePassword()
	{
		do {
			$bytes = openssl_random_pseudo_bytes(24, $strong);
		} while ($strong !== true);

		$string = base64_encode($bytes);

		return rtrim($string, '=');
	}

}