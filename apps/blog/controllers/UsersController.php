<?php

namespace ProfitPress\Blog\Controllers;


use ProfitPress\Blog\Models\Posts as Posts,
    ProfitPress\Blog\Models\Users as Users,
    ProfitPress\Blog\Models\Categories as Categories;

class UsersController extends \Phalcon\Mvc\Controller
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