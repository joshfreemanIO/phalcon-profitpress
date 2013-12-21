<?php

/**
 * Contains the BaseModelTest class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Tests\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

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