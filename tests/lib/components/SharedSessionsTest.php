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

	/**
	 * @dataProvider attributeProvider
	 */
	public function testGetHtmlTag($attributes, $expectedHtmlTag)
	{

		$this->_object->setAttributes($attributes);

		$actualHtmlTag = $this->_object->getHtmlTag();

		$this->assertEquals($expectedHtmlTag, $actualHtmlTag);
	}


	public static function anchorAttributeProvider()
	{

		return array(
			array(array('text' => 'Text', 'uri' => 'home', 'class' => 'red'), '<a href="http://a.b.com/home" class="red">Text</a>'),
			);
	}

	/**
	 * @dataProvider anchorAttributeProvider
	 */
	public function testAnchor($attributes, $expectedAnchorTag)
	{

		$actualAnchorTag = $this->_object->anchor($attributes);

		$this->assertEquals($expectedAnchorTag, $actualAnchorTag);

	}

	public static function buttonAttributeProvider()
	{
		return array(
			array(array('text' => 'Text', 'data-role' => 'home', 'class' => 'red'), '<button data-role="home" class="red">Text</button>'),
			);
	}

	/**
	 * @dataProvider buttonAttributeProvider
	 */
	public function testButton($attributes,$expectedButton)
	{
		$actualButton = $this->_object->button($attributes);

		$this->assertEquals($expectedButton, $actualButton);
	}

	public static function paginatedListProvider()
	{
		return array(
			array(1,3,2,6,'home', '<ul class="pagination pagination-lg"><li><a href="http://a.b.com/home">&laquo;</a></li><li class="active"><a href="http://a.b.com/home1">1</a></li><li><a href="http://a.b.com/home2">2</a></li><li><a href="http://a.b.com/home3">&raquo;</a></li></ul>'),
			array(1,3,2,1,'home', true),
			array(1,3,3,2,'home', '<ul class="pagination pagination-lg"><li><a href="http://a.b.com/home">&laquo;</a></li><li class="active"><a href="http://a.b.com/home1">1</a></li><li><a href="http://a.b.com/home2">2</a></li><li><a href="http://a.b.com/home3">&raquo;</a></li></ul>'),
			array(1,3,5,6,'home', '<ul class="pagination pagination-lg"><li><a href="http://a.b.com/home">&laquo;</a></li><li><a href="http://a.b.com/home-1">-1</a></li><li><a href="http://a.b.com/home0"></a></li><li class="active"><a href="http://a.b.com/home1">1</a></li><li><a href="http://a.b.com/home2">2</a></li><li><a href="http://a.b.com/home3">3</a></li><li><a href="http://a.b.com/home3">&raquo;</a></li></ul>'),
			);
	}

	/**
	 * @dataProvider paginatedListProvider
	 */
	public function testGetPaginatedList($current, $last, $maxPages, $totalPages, $uri, $expectedOutput)
	{
		$actualOutput = $this->_object->getPaginatedList($current, $last, $maxPages, $totalPages, $uri);

		$this->assertEquals($expectedOutput, $actualOutput);
	}
}
