<?php

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