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

use \Phalcon\Mvc\User\Component;

/**
 * Config opens a configuration file and allows access as a service
 *
 * If a configuration is stored in a format other than an associative
 * PHP array (such as XML or JSON), this class allows for the
 * dynamic usage of configuration types provided that the given
 * configuration adapter exists in the provided namespace.
 *
 * @category ProfitPress
 * @package  ProfitPress\Services
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Config extends Component
{

    /**
     * Path to configuration file
     *
     * @var string
     */
    protected $_config_path;

    /**
     * \Phalcon\Config object
     *
     * @var object
     */
    protected $_config;

    /**
     * Namespace for configuration adapters
     *
     * @var string
     */
    protected $_adapter_namespace = '\Phalcon\Config\Adapter';

    /**
     * Config constructor
     *
     * @param string $file_path Path to configuration file
     */
    public function __construct($file_path) {

        $this->_config_path = $file_path;

        $this->initialize();

    }

    /**
     * Sets the $_config property as a loaded object
     *
     * Parses the extension and creates the correct
     * configuration object from necessary adapter
     */
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

    /**
     * Magic getter for the configuration object
     *
     * Gets the configuration value from a configuration key.  Trying to access an
     * undeclared key will throw an exception.
     *
     * @param  string $property Key in configuration array
     * @return string Configuration value
     */
    public function __get($property)
    {

        if (empty($this->_config->$property)) {
            throw new \Phalcon\Exception("$property is empty or does not exist in the configuration object");
        }

        return $this->_config->$property;
    }

    /**
     * Return the configuration property as an associative array
     *
     * Nested configuration arrays return objects, which may be
     * unsuitable for consumption.  This method returns an
     * associative array.
     *
     * @param  string $property Key in configuration array
     * @return array Associative configuration array
     */
    public function getConfigPropertyAsArray($property)
    {
        $config = $this->_config->$property;

        return json_decode(json_encode($config), true);
    }

}
