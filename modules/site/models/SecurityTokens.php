<?php

namespace ProfitPress\Site\Models;

class SecurityTokens extends \ProfitPress\Components\BaseModel
{

    /**
     * Token ID
     *
     * Primary Key for Security Token Model
     *
     * @var int
     */
    public $token_id;

    /**
     * Token Owner ID
     *
     * Foreign Key to Token Owner
     *
     * @var int
     */
    public $token_owner_id;

    /**
     * Type of Token (Password, Single Use, Etc.)
     * @var [type]
     */
    public $token_type;

    /**
     * Token Value
     * @var string
     */
    public $token_value;

    /**
     * Date this token expires
     * @var string
     */
    public $expires = '0000-00-00 00:00:00';

    public function initialize()
    {
        $this->hasOne('token_owner_id', 'ProfitPress\Site\Models\Users', 'user_id', array(
            'alias' => 'user',
            ));
    }

    public function createNewToken($type,$value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function generatePassword($value)
    {
        $this->value = $this->security->hash($value);

        $this->save();
    }
}