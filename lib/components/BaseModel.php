<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\Model,
    ProfitPress\Components\Dispatcher;

class BaseModel extends Model
{

	public function onConstruct()
	{
        $this->setConnectionService('dbapplication');
	}

	public function set($property, $value)
	{
		if(!property_exists($this, $property))
			throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

		$this->$property = $value;
	}

	public function get($property, $value)
	{
		if(!property_exists($this, $property))
			throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

		return $this->$property;
	}
}