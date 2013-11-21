<?php

$eventsManager = new \Phalcon\Events\Manager();

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'ProfitPress\Components' => __LIBDIR__.'components',
        'ProfitPress\Dispatcher' => __LIBDIR__.'dispatcher',
        'ProfitPress\Security' => __LIBDIR__.'security',
        'ProfitPress\Offers' => __APPSDIR__.'offers',
        'ProfitPress\Blog' => __APPSDIR__.'blog',
        'ProfitPress\Account' => __APPSDIR__.'account',
        'ProfitPress\Account\Models' => __APPSDIR__.'account/models/',
        'ProfitPress\Site' => __APPSDIR__.'site',
        'ProfitPress\Site\Models' => __APPSDIR__.'site/models',
        'ProfitPress\Permalink' => __APPSDIR__.'permalink',
        'Vendor' => __LIBDIR__.'vendor',
    )
);

$loader->register();