<?php

namespace ProfitPress\Site\Controllers;

use Phalcon\Tag as Tag;

use ProfitPress\Site\Models\Settings as Settings,
	ProfitPress\Offers\Models\Offers as Offers,
	ProfitPress\Blog\Models\Posts as Posts,
	ProfitPress\Site\Models\Users as Users;

use	ProfitPress\Site\Forms\SettingsForm as SettingsForm,
	ProfitPress\Site\Forms\LoginForm as LoginForm;

use Phalcon\Mvc\View as View;

class SiteController extends \ProfitPress\Components\BaseController
{

	public function homeAction()
	{
		\ProfitPress\Blog\BlogModule::registerAutoloaders();

	    Tag::setTitle('Home');

        $page = 1;

        if (preg_match('/^\d+$/', $this->dispatcher->getParam('page')) === 1)
            $page = $this->dispatcher->getParam('page');

        //Passing a resultset as data
        $posts = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data"  => Posts::find('published = 1'),
                "limit" => 2,
                "page"  => $page,
            )
        );

        $this->view->posts_paginater = $posts->getPaginate();
	}

	public function dashboardAction()
	{
		$this->session->set("username", "Michael");
		$this->session->set("authenticated", true);

        $this->view->setLayout('admin');
		$this->view->username = $this->session->get('username');
		$this->view->links = $this->getTieredAccessLinks();
	}

	private function getTieredAccessLinks($tier_level = 1)
	{
		$class = 'btn btn-lg btn-block';

		$linksConfig = new \Phalcon\Config\Adapter\Ini(__APPSDIR__.'site/config/dashboard.ini');

		$links = array();

		foreach ($linksConfig as $link) {

			$anchor = array('');

			$anchor['uri'] = $link->uri;
			$anchor['title'] = $link->text;
			$anchor['text'] = $link->text;
			$anchor['class'] = $class;

			$a[] = $this->authorizer->isAvailable($link->namespace,$link->action);

			if ($this->authorizer->isAvailable($link->namespace,$link->action)) {
				$anchor['class'] .= ' btn-default';
				$anchor['data-tieraccessible'] = 'true';
			} else {
				$anchor['uri'] = 'upgradetierlevel';
				$anchor['class'] .= ' btn-warning';
				$anchor['data-toggle'] = 'modal';
				$anchor['data-target'] = '#myModal';
				$this->view->modal = true;
			}

			$links[] = $anchor;
		}
		return $links;
	}

	public function accountinfoAction()
	{
        $form = new SettingsForm();

        $user = Users::findFirst(2);

        $user->set('email_address', 'admin@admin.com');
        $user->set('first_name', 'First Name');
        $user->set('last_name', 'Last Name');


        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $setting = new Settings();

            $setting->settings['global_css'] =  $this->request->getPost('global_css');

            foreach ($setting->settings as $key => $value) {
            	Settings::setSetting($key,$value);
            }

            $this->flash->success('You have successfully updated your theme!');

	        $response = new \Phalcon\Http\Response();
	        return $response->redirect('accountinfo');

        }

        $this->view->setLayout('admin');
        $this->view->form = $form;
    }

    public function loginAction()
    {
    	$form = new LoginForm();

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

        	$user = \ProfitPress\Site\Models\Users::findByEmail($this->request->getPost('email_address'));

        	$valid_password = $user->validatePassword($this->request->getPost('password'));


        	if (!$valid_password) {
        		$this->flash->warning('Invalid email or password');
        	} else {

        		$this->flash->success('Successfully Logged In');

        		$tier_level = \ProfitPress\Account\Models\Accounts::getCurrentTierLevel();

        		$this->session->set('role',$tier_level);

        		$response = new \Phalcon\Http\Response();
	        	return $response->redirect('dashboard');

        	}
        }


        $this->view->setLayout('admin');
 		$this->view->form = $form;
    }

    public function logoutAction()
    {
    	$this->session->destroy();

    	// Will need a workaround
        $this->flash->warning('Logged Out');

		$response = new \Phalcon\Http\Response();
    	return $response->redirect();
    }
}