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
            $dispatcher = new \ProfitPress\Components\Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Backend\Controllers");

            $eventsManager = $di->getShared('eventsManager');

            $eventsManager->attach(
                "dispatch:beforeException",
                function($event, $dispatcher, $exception)
                {

                    switch ($exception->getCode()) {
                        case \ProfitPress\Components\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                        case \ProfitPress\Components\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:

                            $dispatcher->forward(
                                array(
                                    'module'     => 'site',
                                    'controller' => 'error',
                                    'action'     => 'error404',
                                )
                            );
                            return false;
                    }
                }
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