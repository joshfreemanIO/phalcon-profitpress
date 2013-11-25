<?php


$di->setShared('site', function () use ($di) {

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
    // $cookie_bag = new Phalcon\Http\Response\Cookies($di);
    // $cookie_bag->setDI($di);
    // $cookie_bag->useEncryption(false);
    // $cookie_bag->set('mastesr', 'vsalsue??', 120, '/',false, 'alpha.profitpress.localhost');
    // // $cookie_bag->set('master', 'value??', 120, '/',false, '.profitpress.localhost');

    // $cookie_bag->send();




$di->setShared('cookies', function () use ($di) {

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

    $cookie_jar = new \Phalcon\Http\Response\Cookies();

    if ($cookie_jar->has('PHPSESSID') !== true) {

        if (empty($_GET['auth_id'])) {


            $return_url = $di->getSite()->protocol . '/' .$di->getSite()->domain_name .  $_SERVER['REQUEST_URI'];

            $auth_url = 'https://auth.profitpress.localhost/cookiebaker/';

            $location = 'Location: '.$auth_url.$return_url;

            return header($location);

        } else {

            $auth_id = $_GET['auth_id'];

            $session_id = apc_fetch($auth_id);

            $cookie = new \Phalcon\Http\Cookie('PHPSESSID', $session_id);

            $cookie->send();

            $cookie->restore();
        }

    }

    session_id($cookie_jar->get('PHPSESSID'));

    $session->start();

    $session->setOptions(array(
        'uniqueId' => $di->getSite()->domain_name.':',
        ));

    if (!$session->has('tier_level')) {
        $tier_level = \ProfitPress\Account\Models\Accounts::getCurrentTierLevel();
        $session->set('tier_level',  $tier_level);
    }

    if (!$session->has('role')) {
        $session->set('role',  'Guest');
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

echo $di->getSession()->get('role');
// echo $di->getSession()->remove('role');
die();