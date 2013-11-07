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

	public static function anchor($link)
	{
		$uri  = (!empty($link['uri'])) ? $link['uri'] : '';
		$text = (!empty($link['text'])) ? $link['text'] : '';
		$attributes = '';

		if (count($link) > 2)
		{
			foreach ($link as $attribute => $value) {
				if ($attribute == 'uri' || $attribute == 'text')
					continue;
				$attributes .= " $attribute='$value'";
			}
		}

		return "<a href='$uri'$attributes>$text</a>";
	}
}