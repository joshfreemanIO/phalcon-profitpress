<?php

namespace ProfitPress\Site\Controllers;

use \Phalcon\Tag as Tag;

class ErrorController extends SiteBaseController
{

	public function error403Action()
	{
		$this->response->setStatusCode(403, 'Forbidden');
	}

	public function error404Action()
	{
		$this->response->setStatusCode(404, 'Not Found');

		$this->view->uri = ltrim($this->router->getRewriteUri(), '/');
	}
}