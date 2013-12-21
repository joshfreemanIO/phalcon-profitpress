<?php

/**
 * Contains the UsersController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Account\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Account\Controllers;

use ProfitPress\Account\Models\Users;


class UsersController extends ProfitPress\Components\BaseController
{

	public function createAction()
	{
		$user = new Users();

		$user->username = 'admin';
		$user->email_address = 'admin@example.com';

		$user->save();
	}

}