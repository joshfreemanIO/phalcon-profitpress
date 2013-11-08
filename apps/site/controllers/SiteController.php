<?php

namespace ProfitPress\Site\Controllers;

use \Phalcon\Tag as Tag;

class SiteController extends SiteBaseController
{

	public function dashboardAction()
	{
		$this->session->set("username", "Michael");
		$this->session->set("authenticated", true);

		$this->view->username = $this->session->get('username');
		$this->view->links = $this->getTieredAccessLinks();
	}

	private function getTieredAccessLinks($tier_level = 1)
	{

		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'blog/create', 'text' => 'Create a Blog Post');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'offers/choosetemplate', 'text' => 'Create a New Offer');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'blog/view', 'text' => 'View Blog Posts');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'offers/viewoffers', 'text' => 'View Offers');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'analytics', 'text' => 'View Statistics');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'trainingResources', 'text' => 'View Training Resources');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'VIPArea', 'text' => 'VIP Area');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'admin-button', 'uri' => 'accountInfo', 'text' => 'Account Info');

		$min_tier_level = array(
			'offers/choosetemplate' => 1,
			'offers/viewoffers' => 1,
			'blog/create' => '1+',
			'blog/view' => '1+',
			'analytics' => 1,
			'trainingResources' => 1,
			'VIPArea' => 3,
			'accountInfo' => 1,

			);

		foreach ($links as &$linkArray) {

			if ($min_tier_level[$linkArray['uri']] <= $tier_level) {
				$linkArray['title'] .= $linkArray['text'];
				$linkArray['data-tieraccessible'] = 'true';
			} else {
				$linkArray['uri'] = 'upgradetierlevel';
				$linkArray['class'] .= ' admin-button-disabled';
				$linkArray['title'] = 'Increase Your Tier Level to access these features!';
			}
		}

		return $links;
	}
}