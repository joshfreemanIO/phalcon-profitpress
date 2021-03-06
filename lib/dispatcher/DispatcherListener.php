<?php

/**
 * Contains the DispatcherListener class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Dispatcher
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Dispatcher;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Dispatcher
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class DispatcherListener
{
	public function beforeExecuteRoute($event, $dispatcher)
	{

		$controller_name = $dispatcher->getHandlerClass();
		$action_name = $dispatcher->getActionName();

		$di = $dispatcher->getDi();

		if (isset($di['authorizer']))
			$dispatcher->getDi()->getAuthorizer()->isAllowed($controller_name, $action_name, $dispatcher);


		// if (isset($di['tier_authorizer']))
			// $dispatcher->getDi()->getShared('tier_authorizer')->isAllowed($controller_name, $action_name, $dispatcher);
	}

	public function beforeException($event, $dispatcher, $exception)
	{
	    switch ($exception->getCode()) {
	        case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
	        case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:

	            $dispatcher->forward(
	                array(
	                    'module'     => 'site',
	                    'controller' => 'error',
	                    'action'     => 'error404',
	                )
	            );
	            return false;
	    }
	}

	public function forbidden($event, $dispatcher)
	{
		return $dispatcher->forward(
            array(
                'module'     => 'site',
                'controller' => 'error',
                'action'     => 'error403',
            )
        );
	}

	public function unauthenticated($event, $dispatcher)
	{

		$dispatcher->forward(
            array(
                'module'     => 'site',
                'controller' => 'site',
                'action'     => 'login',
            )
        );

		$response = new \Phalcon\Http\Response();
        $response->redirect('login');

        $response->send();
	}
}