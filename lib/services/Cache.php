<?php

/**
 * Contains the Cache class
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

use \Phalcon\Mvc\User\Component;

use \Phalcon\Cache\Frontend\Data;

/**
 * Abstract the Phalcon caching into simple setter/getters
 *
 * @category ProfitPress
 * @package  ProfitPress\Services
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Cache extends \Phalcon\Mvc\User\Component
{

    /**
     * Cache object built from default configuration
     *
     * @var object Phalcon cache object
     */
    protected $_default_cache;

    /**
     * Associative configuration array from the Config service
     *
     * @var array
     */
    protected $_default_config;

    /**
     * Array of non-default cache objects other services need
     *
     * @var array
     */
    protected $_stored_caches = array();

    /**
     * Cache constructor
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initialize cache object with default property values
     */
    public function initialize()
    {

        $this->_default_config = $this->getDi()->getShared('config')->getConfigPropertyAsArray('cache');

        $this->_default_cache = $this->buildBackendCache($this->_default_config);
    }

    /**
     * Builds and returns a Memcache object
     *
     * @param  array $config_array Configuration array
     * @return object Memcache object
     */
    protected function cacheMemcache($config_array) {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\Memcache($front_cache, $config_array);
    }

    /**
     * Builds and returns an Apc object
     *
     * @param  array $config_array Configuration array
     * @return object Apc object
     */
    protected function cacheApc($config_array)
    {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\Apc($front_cache, $config_array);
    }

    /**
     * Builds and returns a File cache object
     *
     * @param  array $config_array Configuration array
     * @return object File object
     */
    protected function cacheFile($config_array)
    {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\File($front_cache, $config_array);
    }

    /**
     * Parses a configuration array and builds necessary caches
     *
     * @param  array $config_array Configuration array
     * @return object Multiple object
     */
    protected function buildBackendCache($config_array)
    {
        $cache_array = array();

        foreach ($config_array as $cacheType => $unique_configuration_array) {
            if (method_exists($this, 'cache'.$cacheType)){
                $cache_array[] = $this->{"cache$cacheType"}($unique_configuration_array);
            }
        }

        return new \Phalcon\Cache\Multiple($cache_array);
    }

    public function buildNewCache($config_array)
    {
        $this->_stored_caches[] = $this->buildBackendCache($config_array);

        return key( array_slice($this->_stored_caches, -1, 1, TRUE ));
    }

    public function removeStoredCache($cache_index)
    {
        unset($this->_stored_caches[$cache_key]);
    }

    public function save($cache_key, $cache_value, $cache_index = null)
    {
        if ($cache_index === null) {
            $this->_default_cache->save($cache_key, $cache_value);
        } else if (!empty($this->_stored_caches[$cache_index])) {
            $this->_stored_caches[$cache_index]->save($cache_key, $cache_value);
        }
    }

    public function get($cache_key, $cache_index = null)
    {
        if ($cache_index === null) {
            return $this->_default_cache->get($cache_key);
        } else if (!empty($this->_stored_caches[$cache_index])) {
            return $this->_stored_caches[$cache_index]->get($cache_key);
        }
    }
}
