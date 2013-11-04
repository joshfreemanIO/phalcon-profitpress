<?php

namespace ProfitPress\Offers\Controllers;

use \Phalcon\Tag as Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');

    }


}