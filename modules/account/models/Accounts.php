<?php

namespace ProfitPress\Account\Models;


class Accounts extends AccountBaseModel
{

	protected $subdomain;

	protected $domain;

	public function initialize()
	{
		$this->hasOne('database_connection_id', 'DatabaseConnections', 'database_connection_id');
		$this->hasOne('tier_level_id', 'TierLevels', 'tier_id');
	}

}