<?php

namespace ProfitPress\Account\Models;

class AccountBaseModel extends \ProfitPress\Components\BaseModel
{

	public function onConstruct()
	{
        $this->setConnectionService('dbbackend');
	}

}