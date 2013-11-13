<?php

namespace ProfitPress\Security;

class SecurityListener
{
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
}