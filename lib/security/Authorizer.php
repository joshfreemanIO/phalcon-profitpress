<?php

namespace ProfitPress\Security;

use Phalcon\Mvc\User\Component,
    Phalcon\DiInterface,
    Phalcon\Acl as PhAcl,
    Phalcon\Acl\Resource as AclResource,
    Phalcon\Acl\Adapter\Memory as AclMemory,
    Phalcon\Events\EventsAwareInterface;

class Authorizer extends Component implements EventsAwareInterface
{
    protected $_di;

    protected $_config_path;

	protected $_acl_roles = '/var/www/profitpress/config/aclroles.php';

    /**
     * Shared application EventsManager
     * @var object
     */
    protected $_eventsManager;

    protected $_acl;

    public function __construct($di)
    {
        $this->_di = $di;
    }

    public function setConfigPath($config_path)
    {
        $this->_config_path = $config_path;
    }

    /**
     * Checks if the current profile is allowed to access a resource
     *
     * @param string $profile
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isAllowed($controller, $action, $dispatcher, $nofollow = false)
    {
        $profile = $this->getRole();

        if ($this->getAcl()->isAllowed($profile, $controller, $action)) {
            return true;
        } else {

            if ($nofollow) {
                return false;
            } else {
                $this->_eventsManager->fire('authorizer:forbidden', $dispatcher);
            }
        }
    }

    /**
     * Returns the ACL list
     *
     * @return Phalcon\Acl\Adapter\Memory
     */
    protected function getAcl()
    {

        if (is_object($this->_acl)) {
                return $this->_acl;
        }

        if (!$this->getCachedACL()) {
            $this->_acl = $this->rebuild();
        }

        return $this->_acl;
    }

    /**
     * Rebuilds the access list into a file
     *
     */
    public function rebuild()
    {
        $acl = new AclMemory();

        require_once($this->_config_path);
        // $this->cacheACL();
        // if (is_writable(__DIR__ . $this->_filePath)) {

        //         file_put_contents(__DIR__ . $this->_filePath, serialize($acl));

        //         //Store the ACL in APC
        //         if (function_exists('apc_store')) {
        //                 apc_store('vokuro-acl', $acl);
        //         }

        // } else {
        //         $this->flash->error('The user does not have write permissions');
        // }

        return $acl;
    }

    public function cacheACL()
    {
        $backcache = new Phalcon\Cache\Backend\Data(array(
            'lifetime' => 172800
        ));

        $cache = new \Phalcon\Cache\Backend\File($backcache, array(
          'prefix' => 'app-data',
          'cacheDir' => '/var/www/profitpress/cache/acl/',
        ));

        $cache->save('my-data', array(1, 2, 3, 4, 5));

        return false;
    }

    public function getCachedACL()
    {
        return false;
        $cache = new \Phalcon\Cache\Backend\File($backcache, array(
          'prefix' => 'app-data',
          'cacheDir' => '/var/www/profitpress/cache/acl/',
        ));

        $data = $cache->get('my-data');
        return $data;

    }

    protected function getRole()
    {
        if (!$this->_di->getSession()->get('role'))
            return 'Guest';

        return $this->_di->getSession()->get('role');
    }

    /**
     * Set the event manager, required by EventAwareInterface
     * @param object $eventsManager
     */
    public function setEventsManager($eventsManager)
    {
        $this->_eventsManager = $eventsManager;
    }

    /**
     * Get the event manager, required by EventAwareInterface
     * @return object The events manager
     */
    public function getEventsManager()
    {
        return $this->_eventsManager;
    }
}