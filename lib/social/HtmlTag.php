<?php

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