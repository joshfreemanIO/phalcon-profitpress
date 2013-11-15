<?php

namespace ProfitPress\Account\Controllers;

use ProfitPress\Account\Models\Users as UsersModel,
	ProfitPress\Account\Models\DatabaseConnections as DatabaseConnectionsModel,
	ProfitPress\Account\Models\Accounts as AccountsModel;

use ProfitPress\Account\Forms\AccountForm as AccountForm;

class AccountController extends \ProfitPress\Components\BaseController
{

	public function createAction()
	{

		DatabaseConnectionsModel::createNewConnection();

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

				$database->createDatabase($dbname, $username,$password);
			}
		}

		$this->view->form = $form;
	}

}