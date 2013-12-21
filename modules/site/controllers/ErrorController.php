<?php

/**
 * Contains the ErrorController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Site\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Site\Controllers;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Site\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
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