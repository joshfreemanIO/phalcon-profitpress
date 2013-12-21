<?php

/**
 * Contains the Authenticator class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Security
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

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