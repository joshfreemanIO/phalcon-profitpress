<?php

$application->registerModules(
    array(
        'blog' => array(
            'className' => 'ProfitPress\Blog\BlogModule',
            'path'      => '../apps/blog/BlogModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Blog\Controllers'
                )
        ),
        'offers'  => array(
            'className' => 'ProfitPress\Offers\OffersModule',
            'path'      => '../apps/offers/OffersModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Offers\Controllers'
                )
        ),
        'permalink'  => array(
            'className' => 'ProfitPress\Permalink\PermalinkModule',
            'path'      => '../apps/permalink/PermalinkModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Permalink\Controllers'
                )
        ),
        'site'  => array(
            'className' => 'ProfitPress\Site\SiteModule',
            'path'      => '../apps/permalink/SiteModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Site\Controllers'
                )
            ),
        )
    );