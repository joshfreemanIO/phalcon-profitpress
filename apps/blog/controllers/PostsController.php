<?php

namespace ProfitPress\Blog\Controllers;

class PostsController extends Phalcon\Mvc\Controller
{

	/**
	 * So if we want to check if the User has access to Post::createAction(),
	 * all we need to do is to check if matching session variable exists and contains
	 * expected value. (Keep in mind that this “authorization system” is very simple)
	 */
	public function beforeExecuteRoute($dispatcher)
	{

		//actions which we want to keep from outside access
		$restricted = array('create', 'delete', 'edit', 'new');

		//auth token
		$auth = $this->session->get('auth');

		//we check here if currently invoked action is restricted and if
		//the user is logged in
		if (in_array($dispatcher->getActionName(), $restricted) && !$auth) {

			$this->flash->error("You don't have access to this module");

			$this->dispatcher->forward(array(
				'controller' => 'index',
				'action' => 'index'
			));

			//Returning false means that execute the action must be aborted
			return false;
		}
	}

	/**
	 * We simply pass all the posts created to the view
	 */
	public function indexAction()
    {
    	$this->view->setVar('posts', Posts::find());
    }

    /**
     * Let’s read that record from the database. When using MySQL adapter,
     * like we do in this tutorial, $slug variable will be escaped so
     * we don’t have to deal with it.
     */
    public function showAction($slug)
    {
    	$post = Posts::findFirst(array(
			'slug = :slug:',
			'bind' => array(
				'slug' => $slug
			)
		));

		if ($post === false) {
			$this->flash->error("Sorry, post not found");
			$this->dispatcher->forward(array(
				'controller' => 'posts',
				'action' => 'index'
			));
		}

		$this->view->setVar('post', $post);
    }

    public function createAction()
    {

    }

    public function updateAction()
    {
    }

    public function deleteAction($slug)
    {
    }

}