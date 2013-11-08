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

	private function moduleForwarder($di,$forward)
	{
        $modules = $di->getModulesList();

        if(!isset($modules[ $forward['module'] ])){
            throw new \Phalcon\Mvc\Dispatcher\Exception('Module ' . $forward['module'] . ' has not been registered or does not exist.');
        } else {
            $moduleName = $forward['module'];
        	$moduleData = $modules[ $moduleName ];
        }


        if(!isset($moduleData['metadata']['controllersNamespace'])){
            throw new \Phalcon\Mvc\Dispatcher\Exception('Module ' . $moduleName . ' does not have meta data. Controller namespace must be specified.');
        } else {
        	$controllersNamespace = $moduleData['metadata']['controllersNamespace'];
        }

        $this->setNamespaceName($controllersNamespace);
        $this->setModuleName($moduleName);
        $this->setDefaultNamespace($controllersNamespace);

        $module = new $modules[$moduleName]['className'];

        $module->registerAutoloaders();

        $di->getView()->setViewsDir(__APPSDIR__."$moduleName/views/");

	}
}
