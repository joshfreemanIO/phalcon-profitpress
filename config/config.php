<?php

return new \Phalcon\Config(array(
        'database_pp' => array(
                'adapter'  => 'mysql',
                'host'     => 'localhost',
                'username' => 'profitpress_0001',
                'password' => 'UjsRXJSxvxxhAS5K',
                'dbname'     => 'profitpress_0001',
        ),

        'database_1720' => array(
                'adapter'  => 'Mysql',
                'host'     => 'localhost',
                'username' => 'profitpress_main',
                'password' => 'EBBFhDv2NMpVc59h',
                'dbname'     => 'profitpress_main',
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
