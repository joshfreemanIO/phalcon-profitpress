<?php

namespace ProfitPress\Permalink;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class PermalinkModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Permalink\Controllers' => __ROOTDIR__.'apps/permalink/controllers/',
                'ProfitPress\Permalink\Models'      => __ROOTDIR__.'apps/permalink/models/',
                'ProfitPress\Components'            => __ROOTDIR__.'apps/components',
            )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {

        $di->set('dispatcher', function() use ($di) {
            $dispatcher = new \ProfitPress\Dispatcher\Dispatcher();

            $dispatcher->setDefaultNamespace("ProfitPress\Permalink\Controllers");

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

            return $view;
        });
    }
}