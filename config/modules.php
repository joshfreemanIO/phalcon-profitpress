<?php

$application->registerModules(
    array(
        'blog' => array(
            'className' => 'ProfitPress\Blog\BlogModule',
            'path'      => '../modules/blog/BlogModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Blog\Controllers'
                )
        ),
        'offers'  => array(
            'className' => 'ProfitPress\Offers\OffersModule',
            'path'      => '../modules/offers/OffersModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Offers\Controllers'
                )
        ),
        'permalink'  => array(
            'className' => 'ProfitPress\Permalink\PermalinkModule',
            'path'      => '../modules/permalink/PermalinkModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Permalink\Controllers'
                )
        ),
        'site'  => array(
            'className' => 'ProfitPress\Site\SiteModule',
            'path'      => '../modules/permalink/SiteModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Site\Controllers'
                )
            ),
        )
    );