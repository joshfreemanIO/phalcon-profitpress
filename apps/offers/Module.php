<?php

namespace ProfitPress\Offers;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;

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
                'ProfitPress\Offers\Controllers' => '../apps/offers/controllers/',
                'ProfitPress\Offers\Models'      => '../apps/offers/models/',
                'ProfitPress\Offers\Forms'      => '../apps/offers/forms/',
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
            $dispatcher->setDefaultNamespace("ProfitPress\Offers\Controllers");
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

        $config = include(__DIR__."/../config/config.php");

        if ($_SERVER['SERVER_NAME'] === 'profitpress.localhost' ) {
            $database = $config->database_1720;
        } elseif ($_SERVER['SERVER_NAME'] === 'profitpress.server' ) {
            $database = $config->database_pp;
        }

        $di->set('db', function() use ($database) {
            return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $database->host,
                "username" => $database->username,
                "password" => $database->password,
                "dbname" => $database->name
            ));
        });
    }

}