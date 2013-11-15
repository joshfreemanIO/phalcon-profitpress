<?php

/**
 * Admin
 */

$router->add("/", array(
    'module'     => 'site',
    'controller' => 'site',
    'action'     => 'dashboard',
));

$router->add("/dashboard", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'dashboard',
    ));

$router->add("/accountinfo", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'accountinfo',
    ));

$router->add("/logout", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'logout',
    ));

$router->add("/login", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'login',
    ));
