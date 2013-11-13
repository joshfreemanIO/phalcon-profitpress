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
		$attributes = '';

		if (!empty(self::$_attributes['html'])) {

			foreach (self::$_attributes['html'] as $attribute => $value) {
				$attributes .= " $attribute='$value'";
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
				$attributes .= " $attribute='$value'";
			}
		}

		return "<a href='$uri'$attributes>$text</a>";
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

        echo "<ul class='pagination pagination-lg'>";
        echo "<li>". \ProfitPress\Components\Tag::anchor(array('uri' => "$uri", 'text' => '&laquo;')) ."</li>";
            for ($i=$start, $j = 0; $j < $maxPages; $i++, $j++) {
                $link = array('uri' => "$uri$i", 'text' => $i);
                if ($i == $current)
                	echo "<li class='active'>";
                else
                	echo "<li>";

                echo \ProfitPress\Components\Tag::anchor($link) . "</li>";
            }
        echo "<li>". \ProfitPress\Components\Tag::anchor(array('uri' => "$uri$last", 'text' => '&raquo;')) ."</li>";
        echo "</ul>";
    }

    protected static function buildAttributes($attributes)
    {
		foreach ($attributes as $attribute => $value) {
			if ($attribute == 'uri' || $attribute == 'text')
				continue;
			$string .= " $attribute='$value'";
		}

		return $string;
    }
}