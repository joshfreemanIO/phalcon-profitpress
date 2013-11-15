<?php

/**
 * Handle 'Offers' Module-Specific Routes
 */
$offers = new \Phalcon\Mvc\Router\Group(array(
    'module' => 'offers',
    'controller' => 'offers',
    ));

$offers->setPrefix('/offers');

$offers->add('/:action', array(
    'action'      => 1,
    ));


$offers->add('/:action/{page:[0-9]+}', array(
    'action'      => 1,
    'params'      => 2,
    ));

$offers->add('/create/:int', array(
    'action'      => 'create',
    'template_id' => 1,
    ));

$offers->add('/view/:int', array(
    'action'      => 'view',
    'id' => 1,
    ));
$router->mount($offers);