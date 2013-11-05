<?php

/**
 * Register 'Router' component and specify application routes
 */
$di->set('router', function () {

    return include __CONFIGDIR__.'/routes.php';

});

/**
 * Register 'View' component
 */
$di->set('view', function() {
    $view = new \Phalcon\Mvc\View();
    $view->setViewsDir(__APPSDIR__."/views/");
    $view->registerEngines(array(".volt" => 'volt'));
    return $view;
});

/**
 * Register 'Volt' templating engine
 */
$di->set('volt', function($view, $di) {

        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions(array(
                "compiledPath" => __ROOTDIR__."/cache/volt/"
        ));

        return $volt;
}, true);

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
});

/**
 * Register 'Database' component and configure connection
 */

$config = include(__CONFIGDIR__."/config.php");

if ($_SERVER['SERVER_NAME'] === 'profitpress.localhost' ) {
    $database = $config->database_1720;
} elseif ($_SERVER['SERVER_NAME'] === 'profitpress.server' ) {
    $database = $config->database_pp;
}

$di->set('db', function() use ($database) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => $database->host,
        "username" => $database->username,
        "password" => $database->password,
        "dbname" => $database->name
    ));
});

// $di->set('dispatcher', function() use ($di) {

//     $dispatcher = new ProfitPress\Components\Dispatcher();

//     //Obtain the standard eventsManager from the DI
//     $eventsManager = $di->getShared('eventsManager');

//     $eventsManager->attach(
//         "dispatch:beforeException",
//         function($event, $dispatcher, $exception)
//         {
//             switch ($exception->getCode()) {
//                 case \Phalcon\Mvc\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
//                 case \Phalcon\Mvc\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
//                     $dispatcher->forward(
//                         array(
//                             'controller' => 'error',
//                             'action'     => 'show404',
//                         )
//                     );
//                     return false;
//             }
//         }
//     );

//     return $dispatcher;
// });


$di->set('modulesList', function () use ($application) {
    return $application->getModules();
});