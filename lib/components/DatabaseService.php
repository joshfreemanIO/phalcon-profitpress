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

		$domain_parts = explode('.', $_SERVER['SERVER_NAME']);

		$tld = end($domain_parts);

		if ($tld === 'localhost' ) {
		    $database = $config->database_1720;
		} elseif ($tld === 'server' ) {
		    $database = $config->database_pp;
		}

		return $database;
	}

	protected function getApplicationDatabase()
	{

		$dbarray = \ProfitPress\Account\Models\Accounts::getAccountDatabaseConnection();

		if ($dbarray === false) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("http://profitpress.localhost");
		} else {
			return $dbarray;
		}
	}

	public static function getHostName()
	{
		$server_name = $_SERVER['SERVER_NAME'];

		$hostname['type'] = 'domain';
		$hostname['name'] = $server_name;

		$domain_parts = explode('.', $_SERVER['SERVER_NAME']);

		if (count($domain_parts) > 2) {

			$hostname['type'] = 'subdomain';
			$hostname['name'] = $domain_parts[0];

		}
		return $hostname;
	}
}