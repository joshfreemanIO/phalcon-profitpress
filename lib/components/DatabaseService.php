<?php

namespace ProfitPress\Components;

use \Phalcon\Mvc\User\Component,
\ProfitPress\Backend\Models\DatabaseConnections;

class DatabaseService extends Component
{
	protected $_di;

	protected $_config;

	public function __construct()
	{
		$this->_di = $this->getDi();
		$this->initialize();
	}

	public function initialize()
	{

		$this->setDatabaseConnection('dbbackend',$this->getBackendDatabase());

		$this->setDatabaseConnection('dbapplication', $this->getApplicationDatabase());
	}

	public static function getLoadedDI()
	{
		$obj = new self;
		return $obj->_di;
	}

	protected function setDatabaseConnection($connection_name,$database)
	{

		$this->_di->set($connection_name, function() use ($database) {
		    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		    	'adapter' => $database->adapter,
		        'host' => $database->host,
		        'port' => $database->port,
		        'username' => $database->username,
		        'password' => $database->password,
		        'dbname' => $database->dbname
		    ));
		});

	}

	protected function getBackendDatabase()
	{
		$config = require_once(__CONFIGDIR__."config.php");

		if ($_SERVER['SERVER_NAME'] === 'profitpress.localhost' ) {
		    $database = $config->database_1720;
		} elseif ($_SERVER['SERVER_NAME'] === 'profitpress.server' ) {
		    $database = $config->database_pp;
		}

		return $database;
	}

	protected function getApplicationDatabase()
	{
		return \ProfitPress\Backend\Models\DatabaseConnections::getDatabaseConnectionArray(1);
	}
}