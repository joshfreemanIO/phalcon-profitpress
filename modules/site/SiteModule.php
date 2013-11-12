<?php

namespace ProfitPress\Site;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

class SiteModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Site\Controllers' => __DIR__.'/controllers',
                'ProfitPress\Site\Models'      => __DIR__.'/models',
                'ProfitPress\Site\Forms'       => __DIR__.'/forms',
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
            $dispatcher->setDefaultNamespace("ProfitPress\Site\Controllers");

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

        /**
         * Set access control for module
         */
        // $acl = $di->get('acl');

        $di->set('acl', function() use ($di) {

            $acl = new \ProfitPress\Components\ACL($di);

            return $acl;
        });
    }
}