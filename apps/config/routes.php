<?php

/**
 * Create the base Router object
 */
$router = new \Phalcon\Mvc\Router();

/**
 * Handle 404
 */
$router->notFound(array(
    'module'     => 'site',
    'controller' => 'site',
    'action'     => 'dashboard',
));

/**
 * Handle 404
 */
$router->add("", array(
    'module'     => 'site',
    'controller' => 'site',
    'action'     => 'dashboard',
));

/**
 * Handle 404
 */
$router->add("/:params", array(
    'module'     => 'site',
    'controller' => 'error',
    'action'     => 'error404',
))->setName('error404');

/**
 * Handle Permalinks
 */
$router->add("/([a-zA-Z0-9_\-]*)", array(
    'module'     => 'permalink',
    'controller' => 'permalink',
    'action'     => 'forward',
    'permalink'  => 1
));

/**
 * Admin
 */
$router->add("/dashboard", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'dashboard',
    ));

/**
 * Handle 'Offers' Module-Specific Routes
 */
$offers = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'offers',
    'controller' => 'offers',
    ));

$offers->setPrefix('/offers');

$offers->add('/offers/:action/{page:[0-9]+}', array(
    'action'      => 1,
    'params'      => 2,
    ));

$router->mount($offers);

$router->add("/offers/:action/:params", array(
    'module' =>'offers',
    'controller' => 'offers',
    'action'      => 1,
    'params'      => 2,
    ));

/**
 * Handle 'Blog' Module-Specific Routes
 */
$blog = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'blog',
    'controller' => 'blog',
    'action' => 'index'
    ));

$blog->setPrefix('/blog');

$blog->add('/:controller/:action/:params', array(
    'controller'  => 1,
    'action'      => 2,
    'params'      => 3,
    ));


$router->mount($blog);

$router->removeExtraSlashes(true);

/**
 * Handle 404
 */
$router->add("/", array(
    'module'     => 'site',
    'controller' => 'site',
    'action'     => 'dashboard',
));

return $router;
