<?php

namespace ProfitPress\Offers\Controllers;

use \Phalcon\Tag as Tag;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');

        print_r($this->view);
        die();
	    // $this->resetViewsDirectory();
        // $this->view->setViewsDir(__DIR__."/../views/");

    }

    protected function resetViewsDirectory()
    {
        $module = new \ProfitPress\Offers\OffersModule;
        $module->registerServices($this->getDi());
    }

}