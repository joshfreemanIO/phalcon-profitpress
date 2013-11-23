<?php
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

    $session->start();

    if (!$session->has('tier_level')) {
        $tier_level = \ProfitPress\Account\Models\Accounts::getCurrentTierLevel();
        $session->set('tier_level',  $tier_level);
    }

    if (!$session->has('role')) {
        $session->set('role',  'Guest');
    }

    // if (!$di->has('settings')) {

    //     $settings_bag = new \Phalcon\Session\Bag('setting');

    //     $settings_bag->setDI($di);

    //     $settings = \ProfitPress\Site\Models\Settings::createSettingsSessionBag();

    //     foreach ($settings as $key => $value) {
    //         $settings_bag->set($key, $value);
    //     }
    // }

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
$di->set('volt', function($view, $di) {

        $volt = new \ProfitPress\Components\Volt($view, $di);

        $volt->setOptions(array(
                "compiledPath" => __ROOTDIR__."cache/volt/",
                'macrosFileName' => '../../site/views/layouts/macros',
        ));

        return $volt;
}, true);


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
$di->set('url', function(){
    $url = new Phalcon\Mvc\Url();

    $url->setBaseUri('http://'.$_SERVER['SERVER_NAME'].'/');

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