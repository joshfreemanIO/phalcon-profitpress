<?php

namespace ProfitPress\Site\Controllers;

use \Phalcon\Tag as Tag;

class SiteController extends SiteBaseController
{

	public function dashboardAction()
	{
		$this->session->set("username", "Michael");
		$this->session->set("authenticated", false);

		$links[] = array('uri' => 'offers/choosetemplate', 'text' => 'Create a New Offer');
		$links[] = array('uri' => 'offers/viewoffers', 'text' => 'View Offers');
		$links[] = array('uri' => 'blog/create', 'text' => 'Create a Blog Post');
		$links[] = array('uri' => 'blog/view', 'text' => 'View Blog Posts');
		$links[] = array('uri' => 'analytics', 'text' => 'View Statistics');
		$links[] = array('uri' => 'trainingResources', 'text' => 'View Training Resources');
		$links[] = array('uri' => 'VIPArea', 'text' => 'VIP Area');
		$links[] = array('uri' => 'accountInfo', 'text' => 'Account Info');

		$this->view->username = $this->session->get('username');
		$this->view->links = $links;
	}
}