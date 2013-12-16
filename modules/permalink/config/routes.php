<?php

/**
 * Handle Permalinks
 */
$router->add("/([a-zA-Z0-9_\-]*)", array(
    'module'     => 'posts',
    'controller' => 'posts',
    'action'     => 'view',
    'permalink'  => 1
));
