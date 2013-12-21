<?php

/**
 * Contains the AccountBaseModel class
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

class AccountBaseModel extends \ProfitPress\Components\BaseModel
{

	public function getSource()
	{

		preg_match('/[\w+]+$/', get_class($this), $matches);

		$class = $matches[0];
    	$class = preg_replace( '/([a-z0-9])([A-Z])/', "$1_$2", $class );
    	$class = strtolower($class);

		return $class;
	}

	public function onConstruct()
	{
        $this->setConnectionService('dbbackend');
	}

	public function beforeSave()
	{
		$this->validation();
	}
}
