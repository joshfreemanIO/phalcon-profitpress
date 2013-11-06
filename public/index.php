<?php

use Phalcon\Mvc\Router as Router,
    Phalcon\Mvc\Application as Application,
    Phalcon\DI\FactoryDefault as FactoryDefault;

/**
 * Error Reporting (disable in production)
 */
error_reporting(E_ALL);

$debug = new Phalcon\Debug();
$debug->listen();

/**
 * Manage Constant Definitions (mostly directory shortcuts)
 */
require_once '../apps/config/definitions.php';

/**
 * Create Dependency Injector
 */
$di = new FactoryDefault();

/**
 * Instantiate Application
 */
$application = new Application($di);

/**
 * Register Globally Required Namespaces
 */
require_once __CONFIGDIR__.'/loader.php';

/**
 * Register Modules
 */
require_once __CONFIGDIR__.'/modules.php';

/**
 * Register Services for Dependency Injection
 */
require_once __CONFIGDIR__.'/services.php';

/**
 * Define Default Tags for views
 */
require_once __CONFIGDIR__.'/tags.php';

/**
 * Execute Application
 */
echo $application->handle()->getContent();
