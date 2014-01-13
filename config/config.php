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

    'bootstrap_themes' => array(
        'amelia.bootstrap.min.css' => 'Amelia',
        'bootstrap.min.css' => 'Basic',
        'cerulean.bootstrap.min.css' => 'Cerulean',
        'cosmo.bootstrap.min.css' => 'Cosmo',
        'cyborg.bootstrap.min.css' => 'Cyborg',
        'flatly.bootstrap.min.css' => 'Flatly',
        'journal.bootstrap.min.css' => 'Journal',
        'readable.bootstrap.min.css' => 'Readable',
        'readable.bootstrap.min.css' => 'Readable',
        'simplex.bootstrap.min.css' => 'Simplex',
        'slate.bootstrap.min.css' => 'Slate',
        'spacelab.bootstrap.min.css' => 'Spacelab',
        'united.bootstrap.min.css' => 'United',
    ),

    'default_settings' => array(
        'global_css' => 'bootstrap.min.css',
    ),
);
