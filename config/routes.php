<?php

/**
 * Create the base Router object
 */
$router = new \Phalcon\Mvc\Router();

require_once __APPSDIR__.'permalink/config/routes.php';
require_once __APPSDIR__.'site/config/routes.php';
require_once __APPSDIR__.'account/config/routes.php';
require_once __APPSDIR__.'offers/config/routes.php';
require_once __APPSDIR__.'blog/config/routes.php';


return $router;