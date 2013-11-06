<?php

/**
 * Create the base Router object
 */
$router = new \Phalcon\Mvc\Router();

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

$router->mount($offers);

/**
 * Handle 'Blog' Module-Specific Routes
 */
$blog = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'blog',
    'controller' => 'blog',
    ));

$blog->setPrefix('/blog');

$blog->add('/:controller/:action/:params', array(
    'controller'  => 1,
    'action'      => 2,
    'params'      => 3
    ));


$router->mount($blog);

$router->add("/offers/:controller/:action/:parameters", array(
    'module' => 'offers',
    'controller' => 1,
    'action'     => 2,
    'parameters' => 3,
));

$router->add("/:controller/:action/:parameters", array(
    'module' => 'offers',
    'controller' => 1,
    'action'     => 2,
    'parameters' => 3,
));

$router->removeExtraSlashes(true);

return $router;
