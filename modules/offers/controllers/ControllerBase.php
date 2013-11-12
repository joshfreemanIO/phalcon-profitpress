<?php

namespace ProfitPress\Offers\Controllers;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');
    }
}