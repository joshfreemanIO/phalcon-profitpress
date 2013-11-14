<?php

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