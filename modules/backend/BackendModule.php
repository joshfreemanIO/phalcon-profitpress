<?php

namespace ProfitPress\Backend;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class BackendModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Backend\Controllers' => __DIR__.'/controllers',
                'ProfitPress\Backend\Models'      => __DIR__.'/models',
                'ProfitPress\Backend\Forms'       => __DIR__.'/forms',
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

            $dispatcher->setDefaultNamespace("ProfitPress\Backend\Controllers");

            $eventsManager = $di->getShared('eventsManager');

            $eventsManager->attach(
                'dispatch',
                new \ProfitPress\Dispatcher\DispatcherListener()
            );

            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });


            $dispatcher->setEventsManager($eventsManager);
            return $dispatcher;
        });

        //Registering the view component
        $view = $di->get('view');

        $di->set('view', function() use ($di, $view) {

            $view->setViewsDir(__DIR__."/views/");

            return $view;
        });

        /**
         * Register 'Authorizer' Component
         */
        $di->set('authorizer', function() use ($di) {

            $authorizer = new \ProfitPress\Security\Authorizer($di);
            $authorizer->setConfigPath(__DIR__.'/config/AccessControlList.php');

            $eventsManager = $di->getShared('eventsManager');
            $authorizer->setEventsManager($eventsManager);

            return $authorizer;
        });
    }
}