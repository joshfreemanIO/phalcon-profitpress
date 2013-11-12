<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\Controller,
    ProfitPress\Components\Dispatcher;

class BaseController extends Controller
{

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->session->set('role', 'Manager');
        $role = 'Owner';// $this->user->role;
        $resource = $dispatcher->getHandlerClass();
        $action = $dispatcher->getActionName();

        if (empty($this->acl))
            return true;

        if ( $this->acl->isAllowed($resource, $action) ) {
        } else {
        }
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