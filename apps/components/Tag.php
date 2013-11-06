<?php

namespace ProfitPress\Components;

class Tag extends \Phalcon\Tag
{
	private static $_attributes = array();

	public static function setAttributes( $attributes )
	{
		self::$_attributes  = array_merge(self::$_attributes, $attributes);
	}

	public static function getHtmlTag()
	{
		$attributes = ' ';

		if (!empty(self::$_attributes['html'])) {

			foreach (self::$_attributes['html'] as $attribute => $value) {
				$attributes .= "$attribute='$value'";
			}
		}

		$attributes = rtrim($attributes);

		return "<html$attributes>";
	}
}