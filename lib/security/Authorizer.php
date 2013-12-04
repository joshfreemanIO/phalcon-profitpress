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

	/**
	 * Shared application EventsManager
	 * @var object
	 */
	protected $_eventsManager;

	/**
	 * Phalcon Access Control List
	 * @var object
	 */
	protected $_acl;

	public function __construct($di)
	{
		$this->_di = $di;
	}

	/**
	 * [setConfigPath description]
	 * @param [type] $config_path [description]
	 */
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
	public function isAllowed($controller, $action, $dispatcher = null)
	{
		$role = $this->getRole();

		if ($this->getAcl()->isAllowed($role, $controller, $action)) {
			return true;
		} else {

			if (empty($dispatcher)) {
				return false;
			} else if ($role === 'Guest') {
				$this->_eventsManager->fire('dispatch:unauthenticated', $dispatcher);
			} else {
				$this->_eventsManager->fire('dispatch:forbidden', $dispatcher);
			}
		}
	}

	public function isAvailable($controller, $action)
	{
		$role = $this->session->get('tier_level');

		return $this->getAcl()->isAllowed($role, $controller, $action);
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

		$this->_acl = $this->getCachedACL();

		return $this->_acl;
	}

	public function getCachedACL()
	{

		$frontCache = new \Phalcon\Cache\Frontend\Data(array(
			'lifetime' => 15,
		));

		$cache = new \Phalcon\Cache\Backend\File($frontCache, array(
			'cacheDir' => __CACHEDIR__.'acl/',
		));

		$cache_key = basename($this->_config_path).'.cache';

		$acl = $cache->get($cache_key);

		if ($acl === null) {

			$acl = new AclMemory();
			require_once($this->_config_path);

			$cache->save($cache_key, $acl);
		}

		return $acl;
	}


	protected function getRole()
	{
		if (!$this->_di->getSession()->get('role'))
				return 'Guest';

		return $this->_di->getSession()->get('role');
	}

	protected function getTierLevel()
	{
		return $this->_di->getSession()->get('tier_level');
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