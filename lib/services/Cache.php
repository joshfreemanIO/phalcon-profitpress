<?php

/**
 * Contains Cache class
 *
 * @author     Josh Freeman <jdfreeman@satx.rr.com>
 * @package    ProfitPress\Services
 * @copyright  2013 Help Yourself Today LLC
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

namespace ProfitPress\Services;

use \Phalcon\Cache\Frontend\Data as Data;

class Cache extends \Phalcon\Mvc\User\Component
{

    protected $_default_prefix;

    protected $_default_cache;

    protected $_default_config;

    protected $_stored_caches = array();

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {

        $this->_default_config = $this->getDi()->getShared('config')->getConfigPropertyAsArray('cache');

        $this->_default_cache = $this->buildBackendCache($this->_default_config);
    }

    protected function cacheMemcache($config_array)
    {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\Memcache($front_cache, $config_array);
    }

    protected function cacheApc($config_array)
    {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\Apc($front_cache, $config_array);
    }

    protected function cacheFile($config_array)
    {
        $front_cache = new Data (array(
            "lifetime" => $config_array['lifetime']
        ));

        unset($config_array['lifetime']);

        return new \Phalcon\Cache\Backend\File($front_cache, $config_array);
    }

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
