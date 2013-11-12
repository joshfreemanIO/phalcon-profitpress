<?php

namespace ProfitPress\Permalink\Controllers;

use  ProfitPress\Permalink\Models\Permalinks as Permalinks;

class PermalinkController extends \ProfitPress\Components\BaseController
{

	public function forwardAction($params)
	{

		$permalink_resource = Permalinks::getResources($params);

		if ($permalink_resource === false) {

	        return $this->dispatcher->forward(
	        	array(
					'module' 	 => 'site',
					'controller' => 'error',
					'action'	 => 'error404',
	        ));

		} else {

	        return $this->dispatcher->forward(
	        	array(
					'module' 	 => $permalink_resource['module_name'],
					'controller' => $permalink_resource['controller_name'],
					'action'	 => $permalink_resource['action_name'],
					'params'     => array('resource_id' => $permalink_resource['resource_id']),
	        ));
		}
	}

	public function createPermalink($permalink_name,$module_name,$controller_name,$action_name,$resource_id)
	{

		$permalink = new Permalinks();

		$permalink->setPermalink($permalink_name);
		$permalink->setModuleName($module_name);
		$permalink->setControllerName($controller_name);
		$permalink->setActionName($action_name);
		$permalink->setResourceId($resource_id);

		$permalink->save();
	}
}