<?php

require_once "definitions.php";

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'ProfitPress\Components' => __LIBDIR__.'components',
        'ProfitPress\Services' => __LIBDIR__.'services',
        'ProfitPress\Dispatcher' => __LIBDIR__.'dispatcher',
        'ProfitPress\Security' => __LIBDIR__.'security',
        'ProfitPress\Offers' => __APPSDIR__.'offers',
        'ProfitPress\Posts' => __APPSDIR__.'posts',
        'ProfitPress\Account' => __APPSDIR__.'account',
        'ProfitPress\Account\Models' => __APPSDIR__.'account/models/',
        'ProfitPress\Site' => __APPSDIR__.'site',
        'ProfitPress\Site\Models' => __APPSDIR__.'site/models',
        'ProfitPress\Permalink' => __APPSDIR__.'permalink',
        // 'ProfitPress\Vendor' => __LIBDIR__.'vendor',
        'Michelf' => __LIBDIR__.'vendor/php-markdown/Michelf',
    )
);

$loader->register();