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