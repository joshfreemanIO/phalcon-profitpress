<?php

namespace ProfitPress\Dispatcher;

class DispatcherListener
{
	public function beforeExecuteRoute($event, $dispatcher)
	{
		$controller_name = $dispatcher->getControllerName();
		$action_name = $dispatcher->getActionName();

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

	public function error403($event, $dispatcher)
	{
		return $dispatcher->forward(
	                array(
	                    'module'     => 'site',
	                    'controller' => 'error',
	                    'action'     => 'error403',
	                )
	            );
	}
}