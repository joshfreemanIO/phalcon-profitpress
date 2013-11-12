<?php

namespace ProfitPress\Backend\Models;


class DatabaseConnections extends BackendBaseModel
{

	protected $database_connection_id;

	protected $adapter;

	protected $host;

	protected $port;

	protected $username;

	protected $password;

	public static function getDatabaseConnectionArray($database_connection_id = 1)
	{

		$condition = 'database_connection_id = :database_connection_id:';
		$bind = array('database_connection_id' => $database_connection_id);

		$db = self::findFirst('database_connection_id = 1');//array($condition, 'bind'=>$bind));

		return (object) array(
                'adapter'  => $db->adapter,
                'host'     => $db->host,
                'port'     => $db->port,
                'username' => $db->username,
                'password' => $db->password,
                'dbname'     => $db->database_name,
			);
	}

}