<?php

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();

        if (!$session->isStarted()) {
          $session->start();
        }

        return $session;
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
    $view->setLayoutsDir("/layouts/");
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
$di->set('assets', function () {
  return new Phalcon\Assets\Manager();
}, true);