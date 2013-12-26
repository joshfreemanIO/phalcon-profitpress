<?php

/**
 * Contains the DatabaseConnections class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Account\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Account\Models;

/**
 * Validators
 */
use Phalcon\Mvc\Model\Validator\Regex,
    Phalcon\Mvc\Model\Validator\Uniqueness;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Account\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class DatabaseConnections extends AccountBaseModel
{

	protected $database_connection_id;

	protected $adapter;

	protected $host;

	protected $port;

	protected $username;

	protected $password;

	protected $dbname;

	public function initialize()
	{
		$this->hasOne('database_connection_id', 'Accounts', 'database_connection_id', array(
			'alias' => 'Account'));
	}

	public function getDatabaseConnectionArray()
	{
		return (object) array(
                'adapter'  => $this->adapter,
                'host'     => $this->host,
                'port'     => $this->port,
                'username' => $this->username,
                'password' => $this->password,
                'dbname'   => $this->dbname,
			);
	}


	public static function createNewConnection()
	{
		$connection = new self();

		$id = self::maximum(array('column' => 'database_connection_id')) + 1;

		$name = 'pp_'.$id;

		$password = \ProfitPress\Security\Authenticator::generatePassword();

		$connection->set('adapter', 'mysql');
		$connection->set('host', 'localhost');
		$connection->set('port', 3306);
		$connection->set('username', $name);
		$connection->set('password', $password);
		$connection->set('dbname', $name);

		if ($connection->validation()) {
			return $connection;
		}
	}

	public function validation()
	{

		$this->validate(new Regex (array(
			'field' => 'port',
			'pattern' => '/^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/',
			)));

		return $this->validationHasFailed() != true;
	}

	public function createDatabase()
	{

		$dbname   = $this->dbname;
		$username = $this->username;
		$password = $this->password;

		$dbconfig = require_once(__APPSDIR__."account/config/config.php");

		$connection = new \Phalcon\Db\Adapter\Pdo\Mysql((array) $dbconfig->database_creator);

		$sql  = "CREATE DATABASE `$dbname`;";

		$sql .= "CREATE USER '$username'@'localhost' IDENTIFIED BY '$password';";

		$sql .= "GRANT ALL ON `$dbname`.* TO '$username'@'localhost';";

		$sql .= "FLUSH PRIVILEGES;";

		$connection->execute($sql);

		$connection2 = new \Phalcon\Db\Adapter\Pdo\Mysql((array) $this->getDatabaseConnectionArray());

		$schema = file_get_contents(__ROOTDIR__.'schema/schema.sql');

		$connection2->execute($schema);

	}

	public function deleteDatabase()
	{
		$dbname   = $this->dbname;
		$username = $this->username;
		$host 	  = $this->host;

		$dbconfig = require_once(__APPSDIR__."account/config/config.php");

		$connection = new \Phalcon\Db\Adapter\Pdo\Mysql((array) $dbconfig->database_creator);

		// Delete User
		$sql  = "GRANT USAGE ON *.* TO '$username'@'$host';";

		$sql .= "DROP USER '$username'@'$host';";

		$sql .= "FLUSH PRIVILEGES";

		$connection->execute($sql);

		// Delete Database
		$sql  = "DROP DATABASE IF EXISTS `$dbname`;";

		$connection->execute($sql);

	}

}