<?php

namespace ProfitPress\Offers;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class OffersModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Offers\Controllers' => __DIR__.'/controllers',
                'ProfitPress\Offers\Models'      => __DIR__.'/models',
                'ProfitPress\Offers\Forms'       => __DIR__.'/forms',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {

        //Registering a dispatcher
        $di->set('dispatcher', function() {

            $dispatcher = new \ProfitPress\Components\Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Offers\Controllers");

            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__."/views/");
            $view->setLayoutsDir('../../site/views/layouts/');
            $view->setTemplateAfter('main');
            $view->registerEngines(array(".volt" => 'volt'));
            return $view;
        });

    }
}