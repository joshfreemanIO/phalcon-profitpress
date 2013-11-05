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
                'ProfitPress\Permalink\Controllers' => __ROOTDIR__.'/apps/permalink/controllers/',
                'ProfitPress\Permalink\Models'      => __ROOTDIR__.'/apps/permalink/models/',
                'ProfitPress\Components'            => __ROOTDIR__.'/apps/components',
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

            $dispatcher = new \ProfitPress\Components\Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Permalink\Controllers");
            //Obtain the standard eventsManager from the DI
            $eventsManager = $di->getShared('eventsManager');

            //Bind the EventsManager to the Dispatcher
            $dispatcher->setEventsManager($eventsManager);

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