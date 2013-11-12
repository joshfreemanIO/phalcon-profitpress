<?php

namespace ProfitPress\Components;

use Phalcon\Mvc\User\Component,
    Phalcon\DiInterface,
    Phalcon\Acl as PhAcl,
    Phalcon\Acl\Resource as AclResource,
    Phalcon\Acl\Adapter\Memory as AclMemory;

class ACL extends Component
{

	protected $_acl_roles = '/var/www/profitpress/config/aclroles.php';

	protected $_acl_config = '/var/www/profitpress/modules/offers/config/acl.php';

	protected $_acl;

	public function __construct($di)
	{
		$this->_di = $di;
		return true;
	}

    /**
     * Checks if the current profile is allowed to access a resource
     *
     * @param string $profile
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isAllowed($controller, $action)
    {
    	$profile = $this->getRole();

        return $this->getAcl()->isAllowed($profile, $controller, $action);
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
     * Returns the permissions assigned to a profile
     *
     * @param Profiles $profile
     * @return array
     */
    public function getPermissions(Profiles $profile)
    {
            $permissions = array();
            foreach ($profile->getPermissions() as $permission) {
                    $permissions[$permission->resource . '.' . $permission->action] = true;
            }
            return $permissions;
    }

    /**
     * Returns all the resoruces and their actions available in the application
     *
     * @return array
     */
    public function getResources()
    {
            return $this->_privateResources;
    }

    /**
     * Returns the action description according to its simplified name
     *
     * @param string $action
     * @return $action
     */
    public function getActionDescription($action)
    {
            if (isset($this->_actionDescriptions[$action])) {
                    return $this->_actionDescriptions[$action];
            } else {
                    return $action;
            }
    }

    /**
     * Rebuilds the access list into a file
     *
     */
    public function rebuild()
    {
        $acl = new AclMemory();

        require_once($this->_acl_roles);

        require_once($this->_acl_config);

        $this->cacheACL();
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
		// $backcache = new Phalcon\Cache\Backend\Data(array(
		//     'lifetime' => 172800
		// ));

		// $cache = new Phalcon\Cache\Backend\Apc($backcache, array(
		//   'prefix' => 'app-data'
		// ));

		// $cache->save('my-data', array(1, 2, 3, 4, 5));

		// $data = $cache->get('my-data');
    	return false;
    }

    public function getCachedACL()
    {
    	return false;

    }

    protected function getRole()
    {

    	return $this->_di->getSession()->get('role');
    }
}