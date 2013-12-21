<?php

/**
 * Contains the TierLevels class
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
class TierLevels extends AccountBaseModel
{

	protected $tier_id;

	protected $tier_name;

	public static function getTiersArray() {
		$models = self::find();

		$array = array();

		foreach ($models as $model) {
			$array[$model->tier_id] = $model->tier_name;
		}

		return $array;
	}
}