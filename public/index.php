<?php

use Phalcon\Mvc\Router as Router,
    Phalcon\Mvc\Application as Application,
    Phalcon\DI\FactoryDefault as FactoryDefault;

/**
 * Error Reporting (disable in production)
 */
error_reporting(E_ALL);

$debug = new Phalcon\Debug();
$debug->setUri('http://static.phalconphp.com/debug/1.2.0/');
$debug->listen();

/**
 * Manage Constant Definitions (mostly directory shortcuts)
 */
require_once '../config/definitions.php';


// $frontCache = new \Phalcon\Cache\Frontend\Output(
//     array(
//         'lifetime' => 15,
//     )
// );


// $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
//     'cacheDir' => __CACHEDIR__.'config/',
// ));


// $di = $cache->get('di.cache');
// $application = $cache->get('application.cache');

// if ($di === null || $application === null) {
    /**
     * Create Dependency Injector
     */
    $di = new FactoryDefault();

    /**
     * Instantiate Application
     *
     */
    $application = new Application($di);

    /**
     * Register Globally Required Namespaces
     */
    require_once __CONFIGDIR__.'loader.php';

    /**
     * Register Modules
     */
    require_once __CONFIGDIR__.'modules.php';


    /**
     * Define Default Tags for views
     */
    require_once __CONFIGDIR__.'tags.php';

//     $cache->stop();
//     $cache->save();
//     // $cache->save('di.cache', $di);
//     // $cache->save('application.cache', $application);
// }

    /**
     * Register Services for Dependency Injection
     */
    require_once __CONFIGDIR__.'services.php';

/**
 * Execute Application
 */
echo $application->handle()->getContent();
// echo memory_get_peak_usage();