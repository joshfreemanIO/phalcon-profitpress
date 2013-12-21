<?php

/**
 * Contains the Tag class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Components;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Tag extends \Phalcon\Tag
{
	protected static $_attributes = array();

	public static function setAttributes( $attributes )
	{
		self::$_attributes  = array_merge(self::$_attributes, $attributes);
	}

	public static function getHtmlTag()
	{
		$attributes = '';

		if (!empty(self::$_attributes['html'])) {

			foreach (self::$_attributes['html'] as $attribute => $value) {
				$attributes .= " $attribute=\"$value\"";
			}
		}

		$attributes = rtrim($attributes);

		return "<html$attributes>";
	}

	public static function anchor($link)
	{
		$uri   = self::getUrlService()->getBaseUri();
		$uri  .= (!empty($link['uri'])) ? $link['uri'] : '';
		$text  = (!empty($link['text'])) ? $link['text'] : '';
		$attributes = '';

		if (count($link) > 2)
		{
			foreach ($link as $attribute => $value) {
				if ($attribute == 'uri' || $attribute == 'text')
					continue;
				$attributes .= " $attribute=\"$value\"";
			}
		}

		return "<a href=\"$uri\"$attributes>$text</a>";
	}

	public static function button($attributes)
	{
		$attr = self::buildAttributes($attributes);
		return "<button$attr>".$attributes['text']."</button>";
	}

	public static function getPaginatedList($current, $last, $maxPages, $totalPages, $uri)
    {

    	if ($totalPages == 1) {
    		return true;
    	} else if ( $maxPages > $totalPages ) {
        	$start = 1;
        	$maxPages = $totalPages;
        } elseif ( $last - $current >= $maxPages) {
            $start = $current;
        } else {
            $start = $last - $maxPages + 1;
        }

        $output = '';

        $output .= "<ul class=\"pagination pagination-lg\">";
        $output .= "<li>". \ProfitPress\Components\Tag::anchor(array('uri' => $uri . 1, 'text' => '&laquo;')) ."</li>";
            for ($i=$start, $j = 0; $j < $maxPages; $i++, $j++) {
                $link = array('uri' => "$uri$i", 'text' => $i);

                if ($i == $current)
                	$output .= "<li class=\"active\">";
                else
                	$output .= "<li>";

                $output .= \ProfitPress\Components\Tag::anchor($link) . "</li>";
            }
        $output .= "<li>". \ProfitPress\Components\Tag::anchor(array('uri' => "$uri$last", 'text' => '&raquo;')) ."</li>";
        $output .= "</ul>";

        echo $output;
        return $output;
    }

    protected static function buildAttributes($attributes)
    {
    	$string = '';

		foreach ($attributes as $attribute => $value) {
			if ($attribute == 'uri' || $attribute == 'text')
				continue;
			$string .= " $attribute=\"$value\"";
		}

		return $string;
    }
}