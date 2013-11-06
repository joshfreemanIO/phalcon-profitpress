<?php

$eventsManager = new \Phalcon\Events\Manager();

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
        'ProfitPress\Components' => '/var/www/profitpress/apps/components',//__APPSDIR__.'/components',
        'ProfitPress\Offers' => '/var/www/profitpress/apps/offers',//__APPSDIR__.'/components',
        'ProfitPress\Blog' => '/var/www/profitpress/apps/blog',//__APPSDIR__.'/components',
        'ProfitPress\Site' => '/var/www/profitpress/apps/site',//__APPSDIR__.'/components',
        'ProfitPress\Permalink' => '/var/www/profitpress/apps/permalink',//__APPSDIR__.'/components',
    )
);

$loader->register();