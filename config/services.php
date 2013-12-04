<?php

$di->setShared('site',function () use ($di) {

    $SERVER_SOFTWARE = $_SERVER['SERVER_SOFTWARE'];

    $obj = new stdClass();

    if (strpos($SERVER_SOFTWARE, 'nginx') !== false) {
        $obj->domain_name = $_SERVER['HTTP_HOST'];
    } else {
        $obj->domain_name = $_SERVER['SERVER_NAME'];
    }

    $obj->hostname = $obj->domain_name;

    $domain_parts = explode('.', $obj->hostname);

    if (count($domain_parts) > 2) {
        $obj->type = 'subdomain';
        $obj->hostname = $domain_parts[0];
    }

    $obj->protocol = 'https';

    $obj->base_url = $obj->protocol . '://' . $obj->domain_name;

    if (empty($_SERVER['HTTPS']))
        $obj->protocol = 'http';

    return $obj;

});

$di->setShared('cache', function() use ($di) {

    $ultraFastFrontend = new \Phalcon\Cache\Frontend\Data (array(
        "lifetime" => 3600
    ));

    // $fastFrontend = new \Phalcon\Cache\Frontend\Data (array(
    //     "lifetime" => 86400
    // ));

    $slowFrontend = new \Phalcon\Cache\Frontend\Data (array(
        "lifetime" => 604800
    ));

    //Backends are registered from the fastest to the slower
    $cache = new \Phalcon\Cache\Multiple(array(
        new \Phalcon\Cache\Backend\Apc($ultraFastFrontend, array(
            "prefix" => $di->getShared('site')->domain_name . '-',
        )),
        // new \Phalcon\Cache\Backend\Memcache($fastFrontend, array(
        //     "prefix" => 'cache',
        //     "host" => "localhost",
        //     "port" => "11211"
        // )),
        new \Phalcon\Cache\Backend\File($slowFrontend, array(
            "prefix" => $di->getShared('site')->domain_name . '-',
            "cacheDir" => __CACHEDIR__.'config/',
        )),
    ));

    return $cache;

});

/**
 * Register 'Database' component and configure connection
 */
\ProfitPress\Components\DatabaseService::getLoadedDI();

/**
 * Provide a list of Modules for the Permalink functionality
 */
$di->set('modulesList', function () use ($application) {
    return $application->getModules();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function() use ($di) {

    $session = new \Phalcon\Session\Adapter\Files();

    $shared_session = new \ProfitPress\Components\SharedSessions();

    $return_url = $di->getSite()->protocol . '://' . $di->getSite()->domain_name .  $_SERVER['REQUEST_URI'];

    if ( $shared_session->sessionSlaveIsStarted() !== true ) {

        $key = $shared_session->startSlaveSession($return_url);

        $location = 'https://auth.profitpress.localhost/cookiebaker/'.$key;

        $shared_session->redirect($location);

    } else {

        $shared_session->startSession();

        if (!$session->has('tier_level')) {
            $tier_level = \ProfitPress\Account\Models\Accounts::getCurrentTierLevel();
            $session->set('tier_level',  $tier_level);
        }

        if (!$session->has('role')) {
            $session->set('role',  'Guest');
        }
    }

    return $session;
});

// Need to be optimized so db query isn't called each time.
$di->setShared('settings', function () use ($di) {

    $settings_bag = new \Phalcon\Session\Bag('settings');


    if (!\ProfitPress\Site\Models\Settings::settingsVersionIsCurrent($settings_bag->get('settings_version'))) {

        $settings_bag->setDI($di);

        $settings = \ProfitPress\Site\Models\Settings::getSettings();
        $settings_bag->initialize();

        foreach ($settings as $key => $value) {
            $settings_bag->set($key, $value);
        }
    }


    return $settings_bag;

});

/**
 * Register 'Router' component and specify application routes
 */
$di->set('router', function () {

    return include __CONFIGDIR__.'routes.php';

});

/**
 * Register 'View' component
 */
$di->set('view', function() {
    $view = new \Phalcon\Mvc\View();
    $view->setMainView('../../site/views/layouts/main');
    $view->setLayoutsDir('/layouts/');
    $view->setLayout('layout-guest');
    $view->registerEngines(array(".volt" => 'volt'));
    return $view;
});

/**
 * Register 'Volt' templating engine
 */
$di->setShared('volt', function($view, $di) {

        $volt = new \ProfitPress\Components\Volt($view, $di);

        $volt->setOptions(array(
                "compiledPath" => __ROOTDIR__."cache/volt/",
                'macrosFileName' => '../../site/views/layouts/macros',
        ));

        return $volt;
});


/**
 * Register 'Flash-Session' component
 */
$di->set('flash', function() {
    return new \Phalcon\Flash\Session(array(
      'success' => 'alert alert-success',
      'error'   => 'alert alert-danger',
      'notice'  => 'alert alert-notice',
      'info'    => 'alert alert-info',
      'warning' => 'alert alert-warning',
        ));
});

/**
 * Register 'URL' component and set base URI
 */
$di->set('url', function() use ($di) {
    $url = new Phalcon\Mvc\Url();

    $url->setBaseUri($di->getSite()->base_url.'/');

    return $url;
});

/**
 * Register 'Assets' component
 */
$di->setShared('assets', function () {

    $assets =  new Phalcon\Assets\Manager();

    $assets->collection('head');
    $assets->collection('footer');

    return $assets;
});

/**
 * Register 'Authorizer' Component
 */
$di->setShared('authorizer', function() use ($di) {

    $authorizer = new \ProfitPress\Security\Authorizer($di);
    $authorizer->setConfigPath(__CONFIGDIR__.'AccessControlList.php');

    $eventsManager = $di->getShared('eventsManager');
    $authorizer->setEventsManager($eventsManager);

    return $authorizer;
});

/**
 * Register 'Authorizer' Component
 */
$di->setShared('tier_authorizer', function() use ($di) {

    $tier_authorizer = new \ProfitPress\Security\Authorizer($di);
    $tier_authorizer->setConfigPath(__CONFIGDIR__.'AccessControlList-Tier.php');

    $eventsManager = $di->getShared('eventsManager');
    $tier_authorizer->setEventsManager($eventsManager);

    return $tier_authorizer;
});

//Registering a dispatcher
$di->set('dispatcher', function() use ($di) {
    $dispatcher = new \ProfitPress\Dispatcher\Dispatcher();

    $dispatcher->setDefaultNamespace("ProfitPress\Site\Controllers");

    $eventsManager = $di->getShared('eventsManager');

    $eventsManager->attach(
        'dispatch',
        new \ProfitPress\Dispatcher\DispatcherListener()
    );

    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});
