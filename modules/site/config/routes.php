<?php

$router->add("/", array(
    'module'     => 'site',
    'controller' => 'site',
    'action'     => 'home',
));

$router->add("/page/:int", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'home',
    'page' => 1
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

$router->add("/businesstools", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'businesstools',
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

$router->add("/seotracker", array(
    'module' => 'site',
    'controller' => 'site',
    'action' => 'seotracker',
    ));