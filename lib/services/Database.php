<?php

namespace ProfitPress\Services;

use \Phalcon\Mvc\User\Component,
	\ProfitPress\Backend\Models\DatabaseConnections;

class Database extends \Phalcon\Db\Adapter\Pdo\Mysql
{

	protected $_config;

	public function __construct($connection_type)
	{
		$config_array = $this->getCachedConnectionArray($connection_type);

		if (is_array($config_array)) {
			parent::__construct($config_array);
		}
	}


	public function getConnectionArray($connection_type)
	{
		switch ($connection_type) {
			case 'dbbackend':
				return $this->getBackendDatabaseConfiguration();
				break;

			case 'dbapplication':
				return $this->getApplicationDatabaseConfiguration();
				break;

			default:
				return false;
				break;
		}
	}

	public function getCachedConnectionArray($connection_type)
	{
		switch ($connection_type) {
			case 'dbbackend':
				return $this->getCachedConfiguration('dbbackend', 'getBackendDatabaseConfiguration');
				break;

			case 'dbapplication':
				$site = $this->getDi()->getSite()->domain_name;
				return $this->getCachedConfiguration('dbapplication-'.$site, 'getApplicationDatabaseConfiguration');
				break;

			default:
				return false;
				break;
		}
	}

	protected function getBackendDatabaseConfiguration()
	{
		$config = require_once(__CONFIGDIR__."config.php");

		$domain_parts = explode('.', $_SERVER['SERVER_NAME']);

		$tld = end($domain_parts);

		if ($tld === 'localhost' ) {
		    $database = $config->database_1720;
		} elseif ($tld === 'server' ) {
		    $database = $config->database_pp;
		}

		return (array) $database;
	}

	protected function getApplicationDatabaseConfiguration()
	{

		$dbarray = \ProfitPress\Account\Models\Accounts::getAccountDatabaseConnection();

		if ($dbarray === false) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("http://profitpress.localhost");
		} else {
			return (array) $dbarray;
		}
	}

	protected function getCachedConfiguration($cache_key, $method_name)
	{

		$config_array = array(
			'Apc' => array('lifetime' => 3600, 'prefix' => 'database-'),
		);

		$cache_key = $cache_key . '.cache';

		$cache_id = $this->getDi()->getShared('cache')->buildNewCache($config_array);

		$configuration_array = $this->getDi()->getShared('cache')->get($cache_key, $cache_id);

		if (!is_array($configuration_array)) {
			$configuration_array = $this->{$method_name}();
			$this->getDi()->getShared('cache')->save($cache_key, $configuration_array, $cache_id);
		}

		return $configuration_array;
	}

	protected function getDi()
	{
		return \Phalcon\Di::getDefault();
	}
}