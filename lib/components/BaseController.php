<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{

    public function beforeExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {

    }

    public function afterExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {
        \Phalcon\Tag::appendTitle(' | ProfitPress.com');

    }

    protected function initialize()
    {

        \Phalcon\Tag::appendTitle('ProfitPress | ');

        $this->setCss();
    }

    protected function setCss()
    {
    	$css = \ProfitPress\Site\Models\Settings::getSetting('global_css');

    	if (empty($css)) {
    		$css = 'bootstrap.min.css';
    	}

	    $this->view->css = 'css/'.$css;
    }
}