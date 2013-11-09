<?php

namespace ProfitPress\Components;

class BaseController extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    \Phalcon\Tag::prependTitle('ProfitPress | ');

	    $this->setCss();
    }

    protected function setCss()
    {
    	$css = \ProfitPress\Site\Models\Options::getOption('global_css');

    	if (empty($css)) {
    		$css = 'bootstrap.min.css';
    	}

	    $this->view->css = 'css/'.$css;
    }
}