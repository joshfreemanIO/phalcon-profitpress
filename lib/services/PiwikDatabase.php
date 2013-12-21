<?php

/**
 * Contains the PiwikDatabase class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Services
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Services;

class PiwikDatabase extends \Phalcon\Mvc\User\Component
{

	public function __construct()
	{
		$this->_di = new \Phalcon\DI\FactoryDefault();

		$this->_di->setShared('site', new Hostname);

		$this->_di->setShared('cache', new Cache);

		$this->_di->setShared('dbbackend', new Database('dbbackend'));

		$this->_di->setShared('dbapplication', new Database('dbapplication'));

	}

	public function getConnectionArray()
	{
		return $this->_di->getShared('dbapplication')->getCachedConnectionArray('dbapplication');
	}

}