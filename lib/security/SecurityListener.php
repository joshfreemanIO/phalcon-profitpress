<?php

/**
 * Contains the SecurityListener class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Security
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Security;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Security
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
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