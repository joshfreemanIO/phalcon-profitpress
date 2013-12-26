<?php

/**
 * Contains the BaseModel class
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

use Phalcon\Mvc\Model,
    ProfitPress\Components\Dispatcher;

/**
 * BaseModel provides common methods required by child models
 *
 * This model is abstract, therefore it cannot be instantiated
 * directly and must be extended instead.
 *
 * @category ProfitPress
 * @package  ProfitPress\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
abstract class BaseModel extends Model
{
    /**
     * Table name prefix
     *
     * @var string
     */
    protected $_table_name_prefix = '';

    /**
     * Parses the model name and returns the associated table name
     *
     * @return string Table name corrosponding to the model
     */
    public function getSource()
    {
        preg_match('/[\w+]+$/', get_class($this), $matches);

        $class = $matches[0];
        $class = preg_replace('/([a-z0-9])([A-Z])/', "$1_$2", $class);
        $class = strtolower($class);

        return $this->_table_name_prefix.$class;
    }

    /**
     * Additional procedures during construct
     *
     * Phalcon\Mvc\Model constructer is final, however, it provides a
     * secondary method, onConstruct(), for child classes to use as in
     * lieu of an extendable constructor.
     *
     */
    public function onConstruct()
    {
        $this->setTableNameFromConfiguration();
        $this->setConnectionService('dbapplication');
    }

    /**
     * Set a model property
     *
     * Sets a model propery that has been formally declared.  Trying to set an
     * undeclared will throw an exception.
     *
     * @param string $property Property name to be set
     * @param mixed $value Property value to be stored
     */
    public function set($property, $value)
    {
        if(!property_exists($this, $property))
            throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

        $this->$property = $value;
    }

    /**
     * Get a model property
     *
     * Gets a model propery that has been formally declared.  Trying to access an
     * undeclared will throw an exception.
     *
     * @param string $property Property name to be accessed
     * @return mixed
     */
    public function get($property)
    {
        if(!property_exists($this, $property))
            throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

        return $this->$property;
    }

    /**
     * Returns the current time as a MySQL formatted Time Stamp
     *
     * A MySQL Time Stamp format 1970-01-01 20:45:15 is created
     * from a PHP DateTime object.
     *
     * @return string MySQL formatted current stamp
     */
    public function createCurrentTimeStamp()
    {
        $date_created = new \DateTime();

        return $date_created->format("Y-m-d H:i:s");
    }

    public function getTruncated($property, $chars = 300)
    {
        $filter = new \Phalcon\Filter;

        $text = $this->get($property);

        $text = $filter->sanitize($text, 'striptags');

        $text = $filter->sanitize($text, 'trim');

        $text = substr($text,0,$chars);

        if (strlen($text) === $chars) {
            $text .= '&hellip;';
        }

        return $text;
    }

    /**
     * Sets table name prefix from configuration
     *
     * Reads the shared services configuration object and sets the
     * table name prefix for all models extending off this base class.
     */
    protected function setTableNameFromConfiguration()
    {
        if (!empty($this->getDi()->getShared('config')->model->table_name_prefix)) {
            $this->_table_name_prefix = $this->getDi()->getShared('config')->model->table_name_prefix;
        }
    }

    abstract public function validation();
}