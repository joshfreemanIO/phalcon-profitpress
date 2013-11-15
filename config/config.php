<?php

return new \Phalcon\Config(array(
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

        'application' => array(
                'controllersDir' => __DIR__.'../app/controllers/',
                'modelsDir'      => __DIR__.'../app/models/',
                'viewsDir'       => __DIR__.'../app/views/',
                'pluginsDir'     => __DIR__.'../app/plugins/',
                'libraryDir'     => __DIR__.'../app/library/',
                'formsDir'       => __DIR__.'../app/forms/',
                'baseUri'        => '/',
        ),
        'models' => array(
                'metadata' => array(
                        'adapter' => 'Memory'
                )
        )
));
