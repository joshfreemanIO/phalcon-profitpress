<?php

$eventsManager = new \Phalcon\Events\Manager();

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'ProfitPress\Components' => '/var/www/profitpress/apps/components',//__APPSDIR__.'/components',
        // 'ProfitPress\Offers\Controllers' => '/var/www/profitpress/apps/offers/controllers',//__APPSDIR__.'/components',
        'ProfitPress\Offers' => '/var/www/profitpress/apps/offers',//__APPSDIR__.'/components',
    )
);

$loader->register();