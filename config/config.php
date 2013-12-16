<?php

return array(

    'database_pp' => array(
        'adapter'  => 'mysql',
        'host'     => 'localhost',
        'port'     => '3306',
        'username' => 'profitpress_main',
        'password' => 'C8jTTCWZPpLY2UTU',
        'dbname'   => 'profitpress_main',
    ),

    'database_1720' => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'port'     => '3306',
        'username' => 'profitpress_main',
        'password' => 'EBBFhDv2NMpVc59h',
        'dbname'   => 'profitpress_main',
    ),

    'database_creator' => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'port'     => '3306',
        'username' => 'pp_creator',
        'password' => 'AJsv34GK8V996xcy',
        'dbname'   => 'pp_creator',
    ),

    'models' => array(
        'metadata' => array(
                'adapter' => 'Memory'
        )
    ),

    'cache' => array(
        'Apc' => array(
            'lifetime' => 15,
            'prefix' => 'site-'
        ),

        'File' => array(
            'lifetime' => 15,
            'prefix' => 'site-',
            'cacheDir' => __CACHEDIR__.'config/',
            )
        ),

    'session' => array(
        'auth_url' => 'http://auth.profitpress.localhost',

        )
);
