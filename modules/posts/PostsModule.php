<?php

namespace ProfitPress\Posts;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class PostsModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Posts\Controllers' => __DIR__.'/controllers',
                'ProfitPress\Posts\Models'      => __DIR__.'/models',
                'ProfitPress\Posts\Forms'       => __DIR__.'/forms',
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
        $di->set('dispatcher', function() use ($di) {
            $dispatcher = new \ProfitPress\Dispatcher\Dispatcher();

            $dispatcher->setDefaultNamespace("ProfitPress\Posts\Controllers");

            $eventsManager = $di->getShared('eventsManager');

            $eventsManager->attach(
                'dispatch',
                new \ProfitPress\Dispatcher\DispatcherListener()
            );

            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });

        //Registering the view component
        $view = $di->get('view');

        $di->set('view', function() use ($di, $view) {

            $view->setViewsDir(__DIR__."/views/");

            return $view;
        });

    }

}