<?php

namespace ProfitPress\Services;

class Router extends \Phalcon\Mvc\Router
{
    protected $_acl;

    protected $_routes = array();

    public function __construct($get_cached = true)
    {
        $this->initialize($get_cached);
    }

    public function initialize($get_cached)
    {
        if ($get_cached) {
           $routes = $this->getCachedRoutes();
        } else {
           $routes = $this->createRoutes();
        }

        $this->_routes = $routes;
    }

    protected function createRoutes()
    {
        $router = new \Phalcon\Mvc\Router();

        require_once __APPSDIR__.'permalink/config/routes.php';
        require_once __APPSDIR__.'site/config/routes.php';
        require_once __APPSDIR__.'account/config/routes.php';
        require_once __APPSDIR__.'offers/config/routes.php';
        require_once __APPSDIR__.'posts/config/routes.php';

        return $router->_routes;

    }

    public function getCachedRoutes()
    {

        $cache_key = __CLASS__.'.cache';

        $routes = $this->getDi()->getShared('cache')->get($cache_key);

        if (empty($routes)) {

            $routes = $this->createRoutes();

            $this->getDi()->getShared('cache')->save($cache_key, $routes);
        }

        return $routes;

    }

    public function getDi()
    {
        return \Phalcon\Di::getDefault();
    }

}