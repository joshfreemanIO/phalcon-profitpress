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
        $di->set('dispatcher', function() {
            $dispatcher = new \ProfitPress\Components\Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Site\Controllers");
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