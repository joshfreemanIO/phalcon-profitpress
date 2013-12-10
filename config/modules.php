<?php

$application->registerModules(
    array(
        'posts' => array(
            'className' => 'ProfitPress\Posts\PostsModule',
            'path'      => '../modules/posts/PostsModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Posts\Controllers'
                ),
        ),
        'offers'  => array(
            'className' => 'ProfitPress\Offers\OffersModule',
            'path'      => '../modules/offers/OffersModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Offers\Controllers'
                ),
        ),
        'permalink'  => array(
            'className' => 'ProfitPress\Permalink\PermalinkModule',
            'path'      => '../modules/permalink/PermalinkModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Permalink\Controllers'
                ),
        ),
        'site'  => array(
            'className' => 'ProfitPress\Site\SiteModule',
            'path'      => '../modules/permalink/SiteModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Site\Controllers'
                ),
        ),
        'account'  => array(
            'className' => 'ProfitPress\Account\AccountModule',
            'path'      => '../modules/permalink/AccountModule.php',
            'metadata'  => array(
                'controllersNamespace' => 'ProfitPress\Account\Controllers'
                ),
        ),
    )
);
