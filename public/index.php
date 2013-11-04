<?php

use Phalcon\Mvc\Router,
    Phalcon\Mvc\Application,
    Phalcon\DI\FactoryDefault;

$di = new FactoryDefault();

//Specify routes for modules
$di->set('router', function () {

    $router = new Router();

    $router->setDefaultModule("offers");

    $router->add(":controller/:action/:parameters", array(
    	'module' => 'offers',
        'controller' => 1,
        'action'     => 2,
        'parameters' => 3,
    ));

    return $router;
});

try {

    //Create an application
    $application = new Application($di);

    // Register the installed modules
    $application->registerModules(
        array(
            'blog' => array(
                'className' => 'ProfitPress\Blog\Module',
                'path'      => '../apps/blog/Module.php',
            ),
            'offers'  => array(
                'className' => 'ProfitPress\Offers\Module',
                'path'      => '../apps/offers/Module.php',
            )
        )
    );

    //Handle the request
    echo $application->handle()->getContent();

} catch(\Exception $e){
    echo $e->getMessage();
}