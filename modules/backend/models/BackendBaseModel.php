<?php

namespace ProfitPress\Backend\Models;

class BackendBaseModel extends \ProfitPress\Components\BaseModel
{

	public function onConstruct()
	{
        $this->setConnectionService('dbbackend');
	}

}