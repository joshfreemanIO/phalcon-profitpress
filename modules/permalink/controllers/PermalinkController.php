<?php

/**
 * Contains the PermalinkController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Permalink\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Permalink\Controllers;

use  ProfitPress\Permalink\Models\Permalinks as Permalinks;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Permalink\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
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