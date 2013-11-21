<?php

$router->add("/createaccount", array(
    'module' => 'account',
    'controller' => 'account',
    'action' => 'create',
    ));

$router->add("/deleteaccount/{subdomain:[a-zA-Z0-9]+}", array(
    'module' => 'account',
    'controller' => 'account',
    'action' => 'delete',
    ));