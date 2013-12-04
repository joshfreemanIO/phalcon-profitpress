<?php

namespace ProfitPress\Tests\Components;

use Phalcon\Test\UnitTestCase;

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
