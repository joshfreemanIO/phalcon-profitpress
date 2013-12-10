<?php

namespace ProfitPress\Tests\Social;

use Phalcon\Test\UnitTestCase;

class HtmlTagTest extends UnitTestCase
{

	public function setUp()
	{
		parent::setUp();
	}

	public static function attributeGetHtmlFromConstructProvider()
	{
		return array(
			array(array('a'=>'b','ca'=>'de'), '<meta a="b" ca="de" />'),
			array(array('ca'=>'de'), '<meta ca="de" />'),
			array(array(), '<meta />'),

			);
	}

	/**
	 * @dataProvider attributeGetHtmlFromConstructProvider
	 */
	public function testGetHtmlFromConstruct($attributes, $expected_output)
	{

		$obj = new $this->_tested_class($attributes);

		$this->assertEquals($expected_output, $obj->getHtml());
	}

	public static function attributeGetHtmlFromConstructWithDifferentTagTypeProvider()
	{
		return array(
			array(array('a'=>'b','ca'=>'de'), 'link', '<link a="b" ca="de" />'),
			array(array('ca'=>'de'), 'link', '<link ca="de" />'),
			array(array(), 'link', '<link />'),

			);
	}

	/**
	 * @dataProvider attributeGetHtmlFromConstructWithDifferentTagTypeProvider
	 */
	public function testGetHtmlFromConstructWithDifferentTagType($attributes, $tag_type, $expected_output)
	{
		$obj = new $this->_tested_class($attributes, $tag_type);

		$this->assertEquals($expected_output, $obj->getHtml());
	}

}
