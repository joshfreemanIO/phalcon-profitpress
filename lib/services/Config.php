<?php

/**
 * Contains the Config class
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

// use \Phalcon\Cache\Frontend\Data as Data;

class Config
{

    protected $_config_path;

    protected $_config;

    protected $_adapter_namespace = '\Phalcon\Config\Adapter';

    public function __construct($file_path) {

        $this->_config_path = $file_path;

        $this->initialize();

    }

    public function initialize()
    {
        $parts = pathinfo($this->_config_path);

        $ext = $parts['extension'];

        switch ($ext) {
            case 'php':

                $this->_config = new \Phalcon\Config(require $this->_config_path);

                break;

            default:

                $class = $this->_adapter_namespace . '\\' . ucfirst($ext);

                if (class_exists($class)) {
                    $this->_config = new $class($this->_config_path);
                }

                break;
        }

    }

    public function __get($property)
    {
        return $this->_config->$property;
    }

    public function getConfigPropertyAsArray($property)
    {
        $config = $this->_config->$property;

        return json_decode(json_encode($config), true);
    }

}
