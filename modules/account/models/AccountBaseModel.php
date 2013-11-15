<?php

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
