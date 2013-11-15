<?php

namespace ProfitPress\Account\Models;

/**
 * Validators
 */
use Phalcon\Mvc\Model\Validator\Regex,
	Phalcon\Mvc\Model\Validator\Inclusionin,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Accounts extends AccountBaseModel
{

	protected $account_id;

	protected $subdomain;

	protected $domain;

	protected $database_connection_id;

	protected $tier_level_id;

	protected $date_created;

	public function getSource()
	{
		return 'accounts';
	}

	public function initialize()
	{
		$this->belongsTo('database_connection_id', 'ProfitPress\Account\Models\DatabaseConnections', 'database_connection_id', array(
			'alias' => 'database'
			));

		$this->hasOne('tier_level_id', 'ProfitPress\Account\Models\TierLevels', 'tier_id');

	}

	public function validation()
	{

		$this->validate(new Inclusionin(array(
			'field' => 'tier_level_id',
			'domain' => array_keys(\ProfitPress\Account\Models\TierLevels::getTiersArray()),
            'message' => 'Please choose a valid tier level',
			)));

		$this->validate(new Uniqueness(array(
			'field' => 'subdomain',
			'message' => 'This domain is already taken'
			)));

		return $this->validationHasFailed() != true;
	}


	public function beforeValidationOnCreate()
	{
    	$date_created = new \DateTime();

		$this->set('date_created',$date_created->format("Y-m-d H:i:s"));
	}

	public static function getAccountDatabaseConnection($subdomain)
	{
		$condition = 'subdomain = :subdomain:';
		$bind = array('subdomain' => $subdomain);

		$account = self::findFirst(array($condition, 'bind' => $bind));

		return $account->database->getDatabaseConnectionArray();
	}
}