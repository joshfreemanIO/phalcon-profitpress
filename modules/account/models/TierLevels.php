<?php

namespace ProfitPress\Account\Models;


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