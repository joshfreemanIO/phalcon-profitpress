<?php

namespace ProfitPress\Site\Models;

class Users extends \ProfitPress\Components\BaseModel
{

    protected $user_id;

    protected $email_address;

    public function intialize()
    {
        $this->hasMany('user_id', 'SecurityTokens', 'token_owner_id');
    }

    public static function findByEmail($email_address)
    {
        $condition = 'email_address = :email_address:';
        $bind = array('email_address' => $email_address);

        $user =  self::findFirst(array($condition, 'bind' => $bind));

        return self::findFirst(array($condition, 'bind' => $bind));
    }

    public function generatePassword($password)
    {
        $token = new \ProfitPress\Site\Models\SecurityTokens();

        $hash =  $this->getDi()->getShared('security')->hash($password);

        $token->set('token_type', 'password');
        $token->set('token_value',$hash);
        $token->set('token_owner_id',$this->user_id);

        $token->save();

    }

    public function validatePassword($password)
    {
        $hash = SecurityTokens::findFirst(array('token_type' => 'password', 'token_owner_id' => $this->user_id))->token_value;

        return $this->getDi()->getShared('security')->checkHash($password,$hash);
    }
}