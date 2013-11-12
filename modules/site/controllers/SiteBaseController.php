<?php

namespace ProfitPress\Site\Controllers;

class SiteBaseController extends \ProfitPress\Components\BaseController
{
    protected function initialize()
    {
	    Tag::prependTitle('ProfitPress | ');

    }


}