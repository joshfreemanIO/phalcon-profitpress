<?php

namespace ProfitPress\Account\Models;

/**
 * Validators
 */
use Phalcon\Mvc\Model\Validator\Email,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Users extends AccountBaseModel
{

	protected $user_id;

	protected $username;

	protected $email_address;

	public function initialize()
	{
		$this->hasMany('user_id', 'SecurityTokens', 'token_owner_id');
	}

	public function validation()
	{
		$this->validate(new Uniqueness (array(
			'field' => 'username',
			'message' => 'Username is already taken',
			)));

		$this->validate(new Email (array(
			'field' => 'email_address',
			'message' => 'Invalid Email',
			)));

		return $this->validationHasFailed() != true;
	}
}