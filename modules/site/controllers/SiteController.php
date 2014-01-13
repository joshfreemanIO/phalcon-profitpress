<?php

/**
 * Contains the SiteController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Site\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Site\Controllers;

use ProfitPress\Site\Entities\Settings as SettingsEntity;

use Phalcon\Tag as Tag;

use ProfitPress\Site\Models\Settings as Settings,
	ProfitPress\Offers\Models\Offers as Offers,
	ProfitPress\Posts\Models\Posts as Posts,
	ProfitPress\Site\Models\Users as Users;

use	ProfitPress\Site\Forms\SettingsForm as SettingsForm,
	ProfitPress\Site\Forms\LoginForm as LoginForm;

use Phalcon\Mvc\View as View;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Site\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class SiteController extends \ProfitPress\Components\BaseController
{

	public function homeAction()
	{

        $PostsModule = new \ProfitPress\Posts\PostsModule;
        $PostsModule->registerAutoloaders();

	    Tag::setTitle('Home');

        $page = 1;

        if (preg_match('/^\d+$/', $this->dispatcher->getParam('page')) === 1)
            $page = $this->dispatcher->getParam('page');

        $date = date('Y-m-d H:s:i');

        $posts = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data"  => Posts::find('date_published < NOW()'),
                "limit" => 3,
                "page"  => $page,
            )
        );

        $this->view->posts_paginater = $posts->getPaginate();
	}

	public function dashboardAction()
	{

		$this->session->set("username", "Michael");
		$this->session->set("authenticated", true);

        $this->view->setLayout('layout-admin');
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

        $settings_entity = new SettingsEntity;

        $form = new SettingsForm($settings_entity);


        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $form->bind($this->request->getPost(), $settings_entity);

            $settings = new Settings();

            if ($settings->setSettings($form->getPost(),$form->getElementNames())) {

                $this->flash->success('You have successfully updated your settings!');

                $response = new \Phalcon\Http\Response();

                return $response->redirect('accountinfo');

            } else {

            }
        }

        $this->view->setLayout('layout-admin');
        $this->view->form = $form;
    }

    public function loginAction()
    {
    	$form = new LoginForm();

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $email_address = $form->getSubmittedInputValue('email_address');
            $password = $form->getSubmittedInputValue('password');

            $user = \ProfitPress\Site\Models\Users::findByEmail($email_address);

            if ( !empty($user) && $user->validatePassword($password) ) {

        		$this->flash->success('Successfully Logged In');

        		$tier_level = \ProfitPress\Account\Models\Accounts::getCurrentTierLevel();

        		$this->session->set('role',$tier_level);

        		$response = new \Phalcon\Http\Response();

                return $response->redirect('dashboard');

            } else {

                $this->flash->warning('Invalid email or password');
            }

        } else {
            $this->flashMessages($form, 'error');
        }

        $this->view->setLayout('layout-admin');
 		$this->view->form = $form;
    }

    public function logoutAction()
    {
    	$this->session->destroy();

        setcookie('PHPSESSID', 'null', time() - 24*3600);

    	// Will need a workaround
        // $this->flash->warning('Logged Out');
        //
        // var
        $url = 'https://auth.profitpress.localhost/cookieeater/'. $this->site->protocol .'/'.$this->site->domain_name;

		$response = new \Phalcon\Http\Response();
        return $response->redirect('/');
    	return $response->redirect($url,true);
    }

    public function businesstoolsAction()
    {
        $this->view->setLayout('layout-admin');
    }

    public function seotrackerAction()
    {
        $this->assets->collection('footer')->addJs('javascript/lib/iframe.js');
        $this->view->setLayout('layout-empty');
    }
}