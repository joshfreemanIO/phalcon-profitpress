<?php

/**
 * Contains the Permalinks class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Permalink\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Permalink\Models;



/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Permalink\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Permalinks extends \ProfitPress\Components\BaseModel
{


    /**
     * @var string
     *
     */
    protected $permalink;

    /**
     * @var string
     *
     */
    protected $module_name;

    /**
     * @var string
     *
     */
    protected $controller_name;

    /**
     * @var string
     *
     */
    protected $action_name;

    /**
     * @var string
     *
     */
    protected $resource_id;

    public function setPermalink($permalink)
    {
    	$this->permalink = $permalink;
    }

    public function setModuleName($module_name)
    {
    	$this->module_name = $module_name;
    }

    public function setControllerName($controller_name)
    {
    	$this->controller_name = $controller_name;
    }

    public function setActionName($action_name)
    {
    	$this->action_name = $action_name;
    }

    public function setResourceId($resource_id)
    {
    	$this->resource_id = $resource_id;
    }

    public function getPermalink()
    {
        return $this->permalink;
    }

    public function getModuleName()
    {
        return $this->module_name;
    }

    public function getControllerName()
    {
        return $this->controller_name;
    }

    public function getActionName()
    {
        return $this->action_name;
    }

    public function getResourceId()
    {
        return $this->resource_id;
    }

    public static function getResources($permalink)
    {

    	$permalink = self::findFirst("permalink = '$permalink'");

        if ($permalink === false)
            return false;

    	return array(
        		'module_name' => $permalink->module_name,
        		'controller_name' => $permalink->controller_name,
        		'action_name' => $permalink->action_name,
        		'resource_id' => $permalink->resource_id,
    	);
    }
}