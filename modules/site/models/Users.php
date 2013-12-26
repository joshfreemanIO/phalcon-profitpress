<?php

/**
 * Contains the Users class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Site\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Site\Models;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Site\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Users extends \ProfitPress\Security\BaseSecurityModel
{

    protected $user_id;

    protected $username;

    protected $email_address;

    protected $first_name;

    protected $last_name;

    protected $_unencrypted_properties = array('user_id', 'username', 'email_address');

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

    public function validation(){}
}