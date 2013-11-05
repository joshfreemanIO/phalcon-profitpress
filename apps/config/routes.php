<?php

/**
 * Create the base Router object
 */
$router = new \Phalcon\Mvc\Router();

// $router->setDefaultController('site');
// $router->setDefaultController('error');
// $router->setDefaultAction('error404');

$router->add('/:module/:controller/:action/:params', array(
    'namespace'   => 'ProfitPress\Offers\Controllers',
    'module'      => 1,
    'controller'  => 2,
    'action'      => 3,
    'params' => 4,
    ))->setName('permalink');

/**
 * Handle 'Offers' Module-Specific Routes
 */
$offers = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'offers',
    'controller' => 'offers',
    ));

$offers->setPrefix('/offers');

$offers->add('/:action/:params', array(
    'action'      => 1,
    'params'      => 2
    ));

$offers->add('/:action', array(
    'action' => 1,
    ));


$router->mount($offers);

/**
 * Handle 'Blog' Module-Specific Routes
 */

// $offers = new \Phalcon\Mvc\Router\Group(array(
//     'module' => 'blog',
//     'controller' => 'offers',
//     ));

// $router->add("/blog/:controller/:action/:parameters", array(
//     'module'     => 'offers',
//     'controller' => 1,
//     'action'     => 2,
//     'parameters' => 3,
// ));

// $router->removeExtraSlashes(true);
// // $router->setDefaultModule('offers');

// $router->notFound(array(
//     'module' => 'site',
//     'controller' => 'error',
//     'action' => 'error404',
//     ));

// $router->add("/:parameters", array(
//     'module'     => 'permalink',
//     'controller' => 'permalink',
//     'action'     => 'forward',
//     'params' => 1
// ));

/**
 * Handle Permalinks
 */

$router->add("/permalink-test", array(
    'module'     => 'permalink',
    'controller' => 'permalink',
    'action'     => 'forward',
    'permalink'  => 'permalink-test'
));

// $router->add('/login', array(
//     'module' => 'blog',
//     'controller' => 'users',
//     'action' => 'login',
// ));


// $router->add("/:controller/:action/:parameters", array(
//     'module' => 'offers',
//     'controller' => 1,
//     'action'     => 2,
//     'parameters' => 3,
// ));



return $router;

