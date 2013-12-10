<?php

namespace ProfitPress\Services;

class Acl extends \Phalcon\Mvc\User\Component
{
    protected $_acl;

    public function __construct($get_cached = true)
    {
        if ($get_cached) {
            $this->getCached();
        } else {
            $this->initialize();
        }
    }

    public function initialize()
    {
        $this->_acl = new \Phalcon\Acl\Adapter\Memory;
        $this->_acl->setDefaultAction(\Phalcon\Acl::DENY);
        $this->createRoles();
        $this->addRules();
    }

    protected function createRoles()
    {

        $roleAdmins     = new \Phalcon\Acl\Role('Administrators', 'Application Super User');
        $roleTier3      = new \Phalcon\Acl\Role('Tier 3', 'Tier 3 Owner');
        $roleTier2      = new \Phalcon\Acl\Role('Tier 2', 'Tier 2 Owner');
        $roleTier1Plus  = new \Phalcon\Acl\Role('Tier 1+', 'Tier 1+ Owner');
        $roleTier1      = new \Phalcon\Acl\Role('Tier 1', 'Tier 1 Owner');
        $roleGuests     = new \Phalcon\Acl\Role('Guest', 'Unauthenticated users');

        $this->_acl->addRole($roleGuests);
        $this->_acl->addRole($roleTier1, $roleGuests);
        $this->_acl->addRole($roleTier1Plus, $roleTier1);
        $this->_acl->addRole($roleTier2, $roleTier1Plus);
        $this->_acl->addRole($roleTier3, $roleTier2);
        $this->_acl->addRole($roleAdmins, $roleTier3);

    }


    protected function addRules()
    {
        require_once __APPSDIR__.'account/config/AccessControlList.php';
        require_once __APPSDIR__.'posts/config/AccessControlList.php';
        require_once __APPSDIR__.'offers/config/AccessControlList.php';
        require_once __APPSDIR__.'permalink/config/AccessControlList.php';
        require_once __APPSDIR__.'site/config/AccessControlList.php';
    }

    public function getAcl()
    {
        die("!");
        return $this->_acl;
    }

    public function getCachedAcl()
    {

        // $cache_key = __CLASS__.'.cache';

        // $routes = $this->getDi()->getShared('cache')->get($cache_key);

        // if (empty($routes)) {

        //     $this->initialize();
        //     $this->getDi()->getShared('cache')->save($cache_key, $this);
        // }

        // $this-
    }

    public function test()
    {

    }
}