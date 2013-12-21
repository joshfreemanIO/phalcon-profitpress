<?php

/**
 * Contains the HtmlTag class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Social
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Social;

class HtmlTag
{

	protected $_tag_type = 'meta';

	protected $_attributes = array();

	public function __construct($attributes = array(), $tag_type = 'meta')
	{
		$this->setTagType($tag_type);

		$this->_attributes = $attributes;
	}

	public function setTagType($tag_type)
	{
		$this->_tag_type = $tag_type;
	}

	public function getHtml()
	{

		$html  = '<';
		$html .= $this->_tag_type;
		$html .= ' ';
		$html .= $this->getFormattedAttributes();
		$html .= '/>';
		return $html;
	}

	protected function getFormattedAttributes()
	{
		$formatted_attributes = '';

		foreach ($this->_attributes as $key => $value) {
			$formatted_attributes .= "$key=\"$value\" ";
		}

		return $formatted_attributes;
	}
}