<?php

/**
 * Contains the Accounts class
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
	Phalcon\Mvc\Model\Validator\Inclusionin,
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
class Accounts extends AccountBaseModel
{

	protected $account_id;

	protected $subdomain;

	protected $domain;

	protected $database_connection_id;

	protected $tier_level_id;

	protected $files_directory;

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

		$this->belongsTo('tier_level_id', 'ProfitPress\Account\Models\TierLevels', 'tier_id', array(
			'alias' => 'tier_level',
			));

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

	public static function getAccountDatabaseConnection()
	{
		$account = self::getCurrentAccount();

		if (empty($account)) {
			return false;
		} else {

			$array = $account->database->getDatabaseConnectionArray();

			return $array;
		}
	}

	public static function getCurrentTierLevel()
	{
		$account = self::getCurrentAccount();

		return $account->tier_level->get('tier_name');
	}

	public static function getCurrentAccount()
	{
		$site = \Phalcon\DI::getDefault()->getSite();

		if ($site->type === 'domain') {
			$condition = 'domain = :domain:';
			$bind = array('domain' => $site->hostname);
		} else {
			$condition = 'subdomain = :subdomain:';
			$bind = array('subdomain' => $site->hostname);
		}

		return self::findFirst(array($condition, 'bind' => $bind));

	}

	public static function deleteBySubdomain($subdomain)
	{

		$condition = 'subdomain = :subdomain:';
		$bind = array('subdomain' => $subdomain);

		$model = self::findFirst(array($condition, 'bind' => $bind));

		$model->database->deleteDatabase();

		$model->database->delete();

		$model->delete();
	}
}