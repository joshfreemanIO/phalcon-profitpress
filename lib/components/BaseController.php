<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{

    public function beforeExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {

    }

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