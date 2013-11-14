<?php

namespace ProfitPress\Account\Controllers;

use ProfitPress\Account\Models\Users as UsersModel,
	ProfitPress\Account\Models\Accounts as AccountsModel;

use ProfitPress\Account\Forms\AccountForm as AccountForm;

class AccountController extends \ProfitPress\Components\BaseController
{

	public function createAction()
	{

		$form = new AccountForm;

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

			$user = new UsersModel();
			$user->set('username', $this->request->getPost('username'));
			$user->set('email_address', $this->request->getPost('email_address'));

			$account = new AccountsModel();
			$account->set('subdomain', $this->request->getPost('subdomain'));

			if (!$user->validation()) {

				foreach ($user->getMessages() as $message) {
					$this->flash->error($message);
				}

				return false;
			}

			$user->save();
		}

		$this->view->form = $form;
	}
}