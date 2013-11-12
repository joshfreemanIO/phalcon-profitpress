<?php

namespace ProfitPress\Site\Controllers;

class ErrorController extends \ProfitPress\Components\BaseController
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