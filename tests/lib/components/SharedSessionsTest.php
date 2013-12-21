<?php

/**
 * Contains the SharedSessionsTest class
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

use Phalcon\Test\UnitTestCase;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Tests\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class SharedSessionsTest extends UnitTestCase
{

	public function setUp()
	{
		parent::setUp();
	}

	public static function attributeProvider()
	{
		return array(
			array(array('html' => array()), '<html>'),
			array(array('html' => array('lang' => 'en')), '<html lang="en">'),
			array(array('html' => array('lang' => 'en')), '<html lang="en">'),
			array(array('html' => array('lang' => 'en', 'data-role' => 'data-role')), '<html lang="en" data-role="data-role">'),
		);
	}

	public function testStartMasterSession()
	{
		// session_destroy();
		$this->assertNotEquals(@session_start(), 'PHP_SESSION_ACTIVE');

	}

	public function teardown()
	{
		session_destroy();
	}
}
