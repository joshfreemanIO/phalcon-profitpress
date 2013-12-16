<?php

namespace ProfitPress\Components;

class SharedSessions
{

	protected $_master_hostname = 'profitpress.localhost';

	protected $_master_url = 'http://auth.profitpress.localhost/cookiebaker/';

	protected $_domain = 'http://auth.profitpress.localhost';

	protected $_session_name = 'auth_cookie';

	protected $_query_key = 'auth_id';

	protected $_cookie_jar;

	protected $_max_lifetime = '+2 days';


	public function __construct($domain = null)
	{
		session_name($this->_session_name);

		if (!empty($domain)) {
			$this->_domain = $domain;
		}

		$this->loadCookieJar();
	}

	public function startMasterSession($key)
	{

		$apc_array = unserialize(apc_fetch($key));
		apc_delete($key);

		session_id($apc_array['session_id']);

		session_start();

        $this->bakeCookie($this->_session_name,session_id(), strtotime($this->_max_lifetime), '/', $this->_master_hostname);

		return $apc_array['return_url'];

	}

	public function startSlaveSession($return_url)
	{

		$key = $this->getRandomUrlBytes();

		session_start();

        $this->bakeCookie($this->_session_name, session_id(), strtotime($this->_max_lifetime), '/', $this->_master_hostname);

		$url_parts = parse_url($return_url);
        $this->bakeCookie($this->_session_name, session_id(), strtotime($this->_max_lifetime), '/', $url_parts['host']);

        $apc_array = array('return_url' => $return_url, 'session_id' => session_id());

        apc_store($key, serialize($apc_array),10);

        return $key;

	}


	public function getMasterSessionAuthId()
	{
		if (!empty($_GET[$this->_query_key])) {

            return $_GET[$this->_query_key];

	    } else {

	    	return null;
	    }
	}

	public function sessionSlaveIsStarted()
	{

		return ($this->getCookie($this->_session_name) === null) ? false : true;

	}

	public function cookieMasterDestroy()
	{
		$this->bakeCookie($this->_session_name, session_id(), time() - 3600*24, '/', $this->_master_hostname);
		session_destroy();
	}

	public function redirect($redirect_url = null)
	{
		if ($redirect_url === null) {
			return false;
		} else {
			return header('Location: '.$redirect_url, true, 302);
			exit;
		}
	}

	public function setReturnUrl($return_url)
	{
		$this->_return_url = $return_url;
	}

	protected function bakeCookie($name, $value, $expire = 0, $path ='/', $domain, $secure = true, $httponly = false)
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
	}

	protected function getCookie($cookie_name)
	{
		if (!empty($this->_cookie_jar[$cookie_name])) {
			return $this->_cookie_jar[$cookie_name];
		} else {
			return null;
		}
	}

	public function setSessionName($session_name = null)
	{
		if (!empty($session_name)) {
			$this->_session_name = $session_name;
		}

		session_name($this->_session_name);

	}

	public function startSession()
	{
		session_name($this->_session_name);

		session_start();
	}

	protected function loadCookieJar()
	{
		$this->_cookie_jar = $_COOKIE;
	}

	private function getRandomUrlBytes($min_bytes = 36)
	{
		do {
			$bytes = openssl_random_pseudo_bytes($min_bytes, $strong);
		} while ($strong !== true);

		$string = base64_encode($bytes);

		return preg_replace('/[^a-zA-Z0-9]/', '', $string );
	}

	public function getDomain()
	{
		return $this->_domain;
	}

}