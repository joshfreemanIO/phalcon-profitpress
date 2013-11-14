<?php

namespace ProfitPress\Account\Models;


class SecurityTokens extends AccountBaseModel
{

	protected $token_id;

	protected $token_owner_id;

	protected $token_type;

	protected $token_value;

	protected $expires;

	public function initialize()
	{
		$this->hasOne('token_owner_id', 'Users', 'user_id');
	}

}