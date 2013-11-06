<?php

namespace ProfitPress\Permalink\Models;


class Permalinks extends \Phalcon\Mvc\Model
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