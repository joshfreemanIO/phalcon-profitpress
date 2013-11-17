<?php
use Phalcon\DI,
    Phalcon\DI\FactoryDefault;

ini_set('display_errors',1);
error_reporting(E_ALL);

require_once "../config/definitions.php";

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    array(
		'Phalcon\Test' => __DIR__.'/PhalconBaseTests',
        'ProfitPress\Components' => __LIBDIR__.'components',
        'ProfitPress\Dispatcher' => __LIBDIR__.'dispatcher',
        'ProfitPress\Security' => __LIBDIR__.'security',
        'ProfitPress\Offers' => __APPSDIR__.'offers',
        'ProfitPress\Blog' => __APPSDIR__.'blog',
        'ProfitPress\Account' => __APPSDIR__.'account',
        'ProfitPress\Account\Models' => __APPSDIR__.'account/models/',
        'ProfitPress\Site' => __APPSDIR__.'site',
        'ProfitPress\Site\Models' => __APPSDIR__.'site/models',
        'ProfitPress\Permalink' => __APPSDIR__.'permalink',
    )
);

$loader->register();

$di = new FactoryDefault();
DI::reset();

$di->set('loader', function () use ($loader) {
	return $loader;
});


/**
 * Register 'URL' component and set base URI
 */
$di->set('url', function(){
    $url = new Phalcon\Mvc\Url();

    $url->setBaseUri('http://a.b.com/');

    return $url;
});

// add any needed services to the DI here

DI::setDefault($di);