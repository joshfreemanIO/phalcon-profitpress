<?php

namespace ProfitPress\Site\Controllers;

class SiteController extends \ProfitPress\Components\BaseController
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

		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'blog/posts/create', 'text' => 'Create a Blog Post');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'offers/choosetemplate', 'text' => 'Create a New Offer');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'blog/posts/viewall', 'text' => 'View Blog Posts');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'offers/viewall', 'text' => 'View Offers');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'analytics', 'text' => 'View Statistics');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'trainingResources', 'text' => 'View Training Resources');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'VIPArea', 'text' => 'VIP Area');
		$links[] = array('data-tieraccessible' => 'false', 'class' => 'btn btn-lg btn-block', 'uri' => 'accountInfo', 'text' => 'Account Info');

		$min_tier_level = array(
			'offers/choosetemplate' => 1,
			'offers/viewoffers' => 1,
			'blog/posts/create' => '1+',
			'blog/posts/viewall' => '1+',
			'analytics' => 1,
			'trainingResources' => 1,
			'VIPArea' => 3,
			'accountInfo' => 1,

			);

		foreach ($links as &$linkArray) {

			if ($min_tier_level[$linkArray['uri']] <= $tier_level) {
				$linkArray['class'] .= ' btn-default';
				$linkArray['title'] .= $linkArray['text'];
				$linkArray['data-tieraccessible'] = 'true';
			} else {
				$linkArray['uri'] = 'upgradetierlevel';
				$linkArray['class'] .= ' btn-warning';
				$linkArray['title'] = 'Increase Your Tier Level to access these features!';
			}
		}

		return $links;
	}
}