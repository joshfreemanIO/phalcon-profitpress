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

    	$this->set('files_directory', self::generateFilesPath($this->subdomain));
		$this->set('date_created',$date_created->format("Y-m-d H:i:s"));
	}

	public static function getAccountDatabaseConnection()
	{

		$account = self::getCurrentAccount();

		if (empty($account)) {
			return false;
		} else {
			return $account->database->getDatabaseConnectionArray();
		}

	}

	public static function getCurrentTierLevel()
	{
		$account = self::getCurrentAccount();

		return $account->tier_level->get('tier_name');
	}

	public static function getCurrentAccount()
	{

		$hostname = self::getHostName();

		if ($hostname['type'] === 'domain') {
			$condition = 'domain = :domain:';
			$bind = array('domain' => $hostname['name']);
		} else {
			$condition = 'subdomain = :subdomain:';
			$bind = array('subdomain' => $hostname['name']);
		}


		return self::findFirst(array($condition, 'bind' => $bind));

	}

	private static function getHostName()
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

	private static function generateFilesPath($name)
	{
        $dirname = substr(base64_encode(hash('sha1', $name)),0,8);

		$condition = 'files_directory = :files_directory:';

        do {
			$bind = array('files_directory' => $dirname);
			$model = self::findFirst(array($condition, 'bind' => $bind));
        } while ($model !== false);

        mkdir(__PUBDIR__.'files/'.$dirname);

        return $dirname;
	}

	private static function removeFilesPath($dirname)
	{
		$dir = __PUBDIR__.'files/'.$dirname;
		$it = new \RecursiveDirectoryIterator($dir);
		$files = new \RecursiveIteratorIterator($it,
		             \RecursiveIteratorIterator::CHILD_FIRST);

		foreach($files as $file) {
		    if ($file->getFilename() === '.' || $file->getFilename() === '..') {
		        continue;
		    }
		    if ($file->isDir()){
		        rmdir($file->getRealPath());
		    } else {
		        unlink($file->getRealPath());
		    }
		}
		rmdir($dir);
	}

	public static function deleteBySubdomain($subdomain)
	{

		$condition = 'subdomain = :subdomain:';
		$bind = array('subdomain' => $subdomain);

		$model = self::findFirst(array($condition, 'bind' => $bind));

		$model->database->deleteDatabase();

		$model->database->delete();

		self::removeFilesPath($model->files_directory);

		$model->delete();
	}
}