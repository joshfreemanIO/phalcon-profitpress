<?php

namespace ProfitPress\Site\Controllers;

use \Phalcon\Tag as Tag;

class SiteBaseController extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');
    }

}