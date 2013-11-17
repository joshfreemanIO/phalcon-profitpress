<?php

namespace ProfitPress\Security;

use Phalcon\Mvc\Model;

class BaseSecurityModel extends Model
{

	protected $_unencrypted_properties = array();

	protected $_crypt;

	protected $_key;

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

        $this->_crypt =	new \Phalcon\Crypt();

		$this->_crypt->setKey('Sj!N%BAg8Ou3bEB2fdqfHXR22#4C6Wbb');

	}

	public function set($property, $value)
	{
		if(!property_exists($this, $property))
			throw new \Phalcon\Exception($property.' does not exist in '.get_class($this));

		if ($this->encryptionRequired($property)) {
			$this->$property = $this->_crypt->encrypt($value);
		} else {
			$this->$property = $value;
		}
	}

	public function get($property)
	{
		if(!property_exists($this, $property))
			throw new \Phalcon\Exception($property.' does not exist in '.get_class($this));

		var_dump($this->$property);

		if ($this->encryptionRequired($property)) {
			return $this->_crypt->decrypt($this->$property);
		} else {
			return $this->$property;
		}
	}

	protected function encryptionRequired($property)
	{
		if (in_array($property, $this->_unencrypted_properties)) {
			return false;
		} else {
			return true;
		}
	}
}