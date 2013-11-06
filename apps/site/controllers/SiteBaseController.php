<?php

namespace ProfitPress\Site\Controllers;

use \Phalcon\Tag as Tag;

class SiteBaseController extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');

        $this->view->setViewsDir(__DIR__."/../views/");

    }


}