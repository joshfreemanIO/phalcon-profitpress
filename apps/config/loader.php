<?php

$eventsManager = new \Phalcon\Events\Manager();

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'ProfitPress\Components' => __APPSDIR__.'components',
        'ProfitPress\Offers' => __APPSDIR__.'offers',
        'ProfitPress\Blog' => __APPSDIR__.'blog',
        'ProfitPress\Site' => __APPSDIR__.'site',
        'ProfitPress\Permalink' => __APPSDIR__.'permalink',
    )
);

$loader->register();