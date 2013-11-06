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
            $dispatcher = new \ProfitPress\Components\Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Permalink\Controllers");
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
// die();
            // $module = $di->getRedirectModule();
            // $view->setViewsDir(__DIR__."../$module/views/");

            return $view;
        });
    }
}