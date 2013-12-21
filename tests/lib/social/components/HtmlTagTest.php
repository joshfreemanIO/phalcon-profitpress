<?php

/**
 * Contains the HtmlTagTest class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Tests\Social
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Tests\Social;

use Phalcon\Test\UnitTestCase;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Tests\Social
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
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
