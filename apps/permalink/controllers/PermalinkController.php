<?php

namespace ProfitPress\Permalink\Controllers;

use  ProfitPress\Permalink\Models\Permalinks as Permalinks;

class PermalinkController extends \Phalcon\Mvc\Controller
{

	public function forwardAction($permalink)
	{

		$permalink_resource = Permalinks::getResources($permalink);

        return $this->dispatcher->forward(
        	array(
        		// 'for'		 => 'permalink',
				'module' 	 => $permalink_resource['module_name'],
				'controller' => $permalink_resource['controller_name'],
				'action'	 => $permalink_resource['action_name'],
				'params'     =>
					array('resource_id' => $permalink_resource['resource_id'])
				,
        ));


	}

	public function testAction()
	{
	}
}