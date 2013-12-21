<?php

/**
 * Contains the SharedSessions class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Components;

class SharedSessions
{

	protected $_master_hostname = 'profitpress.localhost';

	protected $_master_url = 'https://auth.profitpress.localhost/cookiebaker/';

	protected $_session_name = 'auth_cookie';

	protected $_query_key = 'auth_id';

	protected $_cookie_jar;

	protected $_domain;


	public function __construct()
	{
		session_name($this->_session_name);

		$this->loadCookieJar();
	}

	public function startMasterSession($return_url)
	{
		session_start();

		do {
			$bytes = openssl_random_pseudo_bytes(24, $strong);
		} while ($strong !== true);

		$string = base64_encode($bytes);

		$key =  rtrim($string, '=');

        $this->bakeCookie($this->_session_name,session_id(), time() - 3600*24, '/', $this->_master_hostname);

		apc_add($key, session_id());

		$redirect_url = $return_url . '?' . $this->_query_key.'='.$key;

		return $redirect_url;

	}

	public function startSlaveSession($return_url)
	{

		if ( $this->sessionSlaveIsStarted() !== true && empty($_GET[$this->_query_key]) ) {

            $location = $this->_master_url.$return_url;

            return $location;

		} elseif (  $this->sessionSlaveIsStarted() !== true && !empty($_GET[$this->_query_key]) ) {

            $auth_id = $_GET[$this->_query_key];

            $session_id = apc_fetch($auth_id);
            apc_delete($auth_id);

            $url_parts = parse_url($return_url);

            $this->bakeCookie($this->_session_name, $session_id, time() - 3600*24, '/', $this->_master_hostname);

   			session_id($session_id);

   			$match = array('/(\?auth_id).*/', '/^(https?)\//');
   			$replace = array('', '$1://');

   			$location = preg_replace($match, $replace, $return_url);

   			return $location;

	    } else {
	    	return null;
	    }
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

}