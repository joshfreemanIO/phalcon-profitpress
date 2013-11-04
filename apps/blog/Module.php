<?php

namespace ProfitPress\Blog;

use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Blog\Controllers' => '../apps/blog/controllers/',
                'ProfitPress\Blog\Models'      => '../apps/blog/models/',
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
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("ProfitPress\Blog\Controllers");
            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__."/views/");
            $view->registerEngines(array(".volt" => 'volt'));
            return $view;
        });

        /**
         * Setting up volt
         */
        $di->set('volt', function($view, $di) {

                $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

                $volt->setOptions(array(
                        "compiledPath" => "../cache/volt/"
                ));

                return $volt;
        }, true);

        $config = include(__DIR__."/config/config.php");

        // $di->set('db', function() use ($config) {
        //     return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        //         "host" => $config->database->host,
        //         "username" => $config->database->username,
        //         "password" => $config->database->password,
        //         "dbname" => $config->database->name
        //     ));
        // });
    }

}