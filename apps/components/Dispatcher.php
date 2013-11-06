<?php

namespace ProfitPress\Components;

class Dispatcher extends \Phalcon\Mvc\Dispatcher
{

    public function forward($forward)
    {

        if(isset($forward['module']))
            $this->moduleForwarder($this->getDi(), $forward);

        parent::forward($forward);

    }

    public function beforeException($exception)
    {
    }


	private function moduleForwarder($di,$forward)
	{
        $modules = $di->getModulesList();

        if(!isset($modules[ $forward['module'] ])){
            throw new \Phalcon\Mvc\Dispatcher\Exception('Module ' . $forward['module'] . ' has not been registered or does not exist.');
        } else {
        	$moduleData = $modules[ $forward['module'] ];
        }


        if(!isset($moduleData['metadata']['controllersNamespace'])){
            throw new \Phalcon\Mvc\Dispatcher\Exception('Module ' . $forward['module'] . ' does not have meta data. Controller namespace must be specified.');
        } else {
        	$controllersNamespace = $moduleData['metadata']['controllersNamespace'];
        }

        $this->setNamespaceName($controllersNamespace);
        $this->setModuleName($forward['module']);
        $this->setDefaultNamespace($controllersNamespace);

        $module = new $modules[$forward['module']]['className'];

        $module->registerAutoloaders();
        $module->registerServices($di);

	}
}
