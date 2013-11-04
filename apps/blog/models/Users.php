<?php


class Users extends \Phalcon\Mvc\Model 
{

    /**
     * @var integer
     *
     */
    public $id;

    /**
     * @var string
     *
     */
    public $login;

    /**
     * @var string
     *
     */
    public $password;


    /**
     * Initializer method for model.
     */
    public function initialize()
    {        
        $this->hasMany("id", "Posts", "users_id");
    }

}
