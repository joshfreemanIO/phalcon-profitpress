<?php

namespace ProfitPress\Tests\Components;

use Phalcon\Test\ModelTestCase;

class BaseModelTest extends ModelTestCase
{

	// public function testSet()
	// {
	// 	try {

	// 		$this->_object->set('adsf','aasdf');

	// 	} catch (\Phalcon\Exception $e) {
	// 		return;
	// 	}

	// }

	public function testSetException()
	{
		try {

			$this->_object->set('adsfasdfasdf','adfasdfasdf');

		} catch (\Phalcon\Exception $e) {
			return;
		}

		$this->fail('An exception has not been raised.');
	}
}