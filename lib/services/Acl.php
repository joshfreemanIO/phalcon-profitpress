<?php

/**
 * Contains the Acl class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Services
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Services;

/**
 * The Acl (Access Control List) Class
 *
 * This class is designed to be a Phalcon services that
 * loads access control lists and provide access control based
 * upon those lists.
 *
 * @category ProfitPress
 * @package  ProfitPress\Services
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Acl extends \Phalcon\Mvc\User\Component
{
    /**
     * The access control list adapter object
     *
     * @var object
     * @see Phalcon\Acl\Adapter\Memory
     * @see Acl::initialize()
     */
    protected $_acl;

    /**
     * Acl constructor
     * @param boolean $get_cached Use caching when...
     */
    public function __construct($get_cached = true)
    {
        if ($get_cached) {
            $this->getCached();
        } else {
            $this->initialize();
        }
    }

    /**
     * Calls required methods to setup the object
     *
     */
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

    // public function getAcl()
    // {
    //     return $this->_acl;
    // }

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

}