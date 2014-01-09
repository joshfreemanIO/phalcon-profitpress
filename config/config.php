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
        'username' => 'pp_main',
        'password' => '3b75YK4p7BWDJNGs',
        'dbname'   => 'pp_main',
    ),

    'database_creator' => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'port'     => '3306',
        'username' => 'pp_creator',
        'password' => 'AJsv34GK8V996xcy',
        'dbname'   => 'pp_creator',
    ),

    'model' => array(
        'table_name_prefix' => 'profitpress_',
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
    ),

    'restricted_subdomains' => array(
        'auth',
        'blog',
        'forum',
    ),
);
