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
 * BaseModel provides common methods required by extended models.
 *
 * This model is abstract, and cannot not be instantiated directly.
 *
 * @category ProfitPress
 * @package  ProfitPress\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://documentation.profitpress.com
 * @since    1.0.0
 */
abstract class BaseModel extends Model
{

    protected $table_name_prefix = '';

    /**
     * Base model constructor
     */
    public function __construct()
    {
        // $this->_configuration = $this->getDi()->getShared('config')->model;

    }

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

        return 'profitpress_'.$class;
    }

    public function onConstruct()
    {
        $this->setConnectionService('dbapplication');
    }

    public function set($property, $value)
    {
        if(!property_exists($this, $property))
            throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

        $this->$property = $value;
    }

    public function get($property)
    {
        if(!property_exists($this, $property))
            throw new \Phalcon\Exception($property.' does not exist in '.__CLASS__);

        return $this->$property;
    }

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

    protected function setTableNameFromConfiguration()
    {
        // if (!empty($this->_configuration->table_name_prefix)) {
        //  $this->_table_name_prefix = $this->_configuration->table_name_prefix;
        // }
    }

}
