<?php

/**
 * Contains the AccountModule class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Account
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Account;

use \Phalcon\Loader,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\ModuleDefinitionInterface;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Account
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class AccountModule implements ModuleDefinitionInterface
{

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'ProfitPress\Account\Controllers' => __DIR__.'/controllers',
                'ProfitPress\Account\Models'      => __DIR__.'/models',
                'ProfitPress\Account\Forms'       => __DIR__.'/forms',
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

            $dispatcher->setDefaultNamespace("ProfitPress\Account\Controllers");

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