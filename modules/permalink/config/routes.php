<?php

/**
 * Handle Permalinks
 */
$router->add("/([a-zA-Z0-9_\-]*)", array(
    'module'     => 'permalink',
    'controller' => 'permalink',
    'action'     => 'forward',
    'permalink'  => 1
));
