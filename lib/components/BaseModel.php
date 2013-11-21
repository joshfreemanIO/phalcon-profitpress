<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\Model,
    ProfitPress\Components\Dispatcher;

class BaseModel extends Model
{

	public function getSource()
	{
		preg_match('/[\w+]+$/', get_class($this), $matches);

		$class = $matches[0];
    	$class = preg_replace( '/([a-z0-9])([A-Z])/', "$1_$2", $class );
    	$class = strtolower($class);

		return 'profitpress_'.$class;
	}

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

	public function get($property)
	{
		if(!property_exists($this, $property))
			throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

		return $this->$property;
	}

	public function createCurrentTimeStamp()
	{
		$date_created = new \DateTime();

		return $date_created->format("Y-m-d H:i:s");
	}

	public function getTruncated($property, $chars = 300) {

		$filter = new \Phalcon\Filter;

		$text = $this->get($property);

		$text = $filter->sanitize($text, 'striptags');

		$text = $filter->sanitize($text, 'trim');

		$text = substr($text,0,$chars);

	    if (strlen($text) === $chars) {
	    	$text .= '&hellip;';
	    }
	    return $text;
	}
}