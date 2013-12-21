<?php

/**
 * Contains the AccountController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Account\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Account\Controllers;

use ProfitPress\Account\Models\Users as UsersModel,
	ProfitPress\Account\Models\DatabaseConnections as DatabaseConnectionsModel,
	ProfitPress\Account\Models\Accounts as AccountsModel;

use ProfitPress\Account\Forms\AccountForm as AccountForm;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Account\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class AccountController extends \ProfitPress\Components\BaseController
{

	public function createAction()
	{

		$form = new AccountForm;

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

			$account = new AccountsModel();
			$account->set('subdomain', $this->request->getPost('subdomain'));
			$account->set('tier_level_id', $this->request->getPost('tier_level_id'));
			$account->database = DatabaseConnectionsModel::createNewConnection();

			$database = DatabaseConnectionsModel::createNewConnection();

			$account->database = $database;

			if (!$account->validation() || !$account->save()) {

				foreach ($account->getMessages() as $message) {
					$this->flash->error($message);
				}

			} else {
				$this->flash->success('Account created!');

				$database->createDatabase();
			}
		}

		$this->view->form = $form;
	}

	public function deleteAction($subdomain = null)
	{

		AccountsModel::deleteBySubdomain($subdomain);
	}

}