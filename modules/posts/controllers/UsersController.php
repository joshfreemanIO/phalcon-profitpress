<?php

/**
 * Contains the UsersController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Posts\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Posts\Controllers;


use ProfitPress\Posts\Models\Posts as Posts,
    ProfitPress\Posts\Models\Users as Users,
    ProfitPress\Posts\Models\Categories as Categories;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Posts\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class UsersController extends \ProfitPress\Components\BaseController
{

	public function indexAction()
	{

	}

	public function loginAction()
	{

		if ($this->request->isPost()) {

			$user = Users::findFirst(array(
				'login = :login: and password = :password:',
				'bind' => array(
					'login' => $this->request->getPost("login"),
					'password' => sha1($this->request->getPost("password"))
				)
			));

			if ($user === false){
				$this->flash->error("Incorrect credentials");
				return $this->dispatcher->forward(array(
					'controller' => 'users',
					'action' => 'index'
				));
			}

			$this->session->set('auth', $user->id);

			$this->flash->success("You've been successfully logged in");
		}

		return $this->dispatcher->forward(array(
			'controller' => 'posts',
			'action' => 'index'
		));
	}

	public function logoutAction()
	{
		$this->session->remove('auth');
		return $this->dispatcher->forward(array(
			'controller' => 'posts',
			'action' => 'index'
		));
	}

}