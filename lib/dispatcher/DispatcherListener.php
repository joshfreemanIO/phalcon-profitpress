<?php

namespace ProfitPress\Dispatcher;

class DispatcherListener
{
	public function beforeExecuteRoute($event, $dispatcher)
	{

		$controller_name = $dispatcher->getHandlerClass();
		$action_name = $dispatcher->getActionName();

		$di = $dispatcher->getDi();

		if (isset($di['authorizer']))
			$dispatcher->getDi()->getAuthorizer()->isAllowed($controller_name,$action_name, $dispatcher);
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