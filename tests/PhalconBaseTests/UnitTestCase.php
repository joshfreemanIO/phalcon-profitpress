<?php

/**
 * Contains the UnitTestCase class
 *
 * @category  ProfitPress
 * @package   Phalcon\Test
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace Phalcon\Test;

use Phalcon\DI\FactoryDefault;
use Phalcon\Config;
use Phalcon\DI;
use Phalcon\DiInterface;
use Phalcon\Mvc\Url;

/**
 * Class UnitTestCase
 * @package Phalcon\Test
 */

/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  Phalcon\Test
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
abstract class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    // Holds the configuration variables and other stuff
    // I can use the DI container but for tests like the Translate
    // we do not need the overhead
    protected $config = array();

    /**
     * @var object
     */
    protected $di;

    /**
     * @var bool
     */
    protected $_loaded;

    /**
     * Sets the test up by loading the DI container and other stuff
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-09-30
     *
     * @param \Phalcon\DiInterface $di
     * @param \Phalcon\Config $config
     * @return DI
     */
    protected function setUp(DiInterface $di = null, Config $config = null)
    {
        $this->checkExtension('phalcon');

        if(!is_null($config)){
            $this->config = $config;
        }

        $di = DI::getDefault();


        if(is_null($di)){

            // Reset the DI container
            DI::reset();

            // Instantiate a new DI container
            $di = new FactoryDefault();


            $di->set(
                'escaper',
                function () {
                    return new \Phalcon\Escaper();
                }
            );
        }

        $this->di = $di;
        $this->autoLoadTestedClass();
        $this->_loaded = true;
    }

    protected function autoLoadTestedClass()
    {

        $class = get_class($this);

        $tested_class = preg_replace('/\\\Tests/','', $class);
        $tested_class = preg_replace('/Test$/','', $tested_class);


        $reflection = new \ReflectionClass($tested_class);

        if ($reflection->isAbstract()) {
            $this->_object = $this->getMockForAbstractClass($tested_class);
        } else {
            $this->_object = new $tested_class;
            $this->_tested_class = $tested_class;
        }
    }

    /**
     * Checks if a particular extension is loaded and if not it marks
     * the tests skipped
     *
     * @param $extension
     */
    public function checkExtension($extension)
    {
        if (!extension_loaded($extension)) {
            $this->markTestSkipped("Warning: {$extension} extension is not loaded");
        }
    }

    /**
     * Returns a unique file name
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-09-30
     *
     * @param string $prefix    A prefix for the file
     * @param string $suffix    A suffix for the file
     *
     * @return string
     *
     */
    protected function getFileName($prefix = '', $suffix = 'log')
    {
        $prefix = ($prefix) ? $prefix . '_' : '';
        $suffix = ($suffix) ? $suffix       : 'log';

        return uniqid($prefix, true) . '.' . $suffix;
    }

    /**
     * Removes a file from the system
     *
     * @author Nikos Dimopoulos <nikos@phalconphp.com>
     * @since  2012-09-30
     *
     * @param $path
     * @param $fileName
     */
    protected function cleanFile($path, $fileName)
    {
        $file  = (substr($path, -1, 1) != "/") ? ($path . '/') : $path;
        $file .= $fileName;

        $actual = file_exists($file);

        if ($actual) {
            unlink($file);
        }
    }

    /**
     * Check if the test case is setup properly
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct() {
        if(!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
        }
    }
}