<?php

namespace ProfitPress\Components;

class Volt extends \Phalcon\Mvc\View\Engine\Volt
{


    public function getCompiler()
    {

      $options = $this->getOptions();

      if (empty($this->_compiler) && !empty($options['macrosFileName']))
      {
        parent::getCompiler();

        $this->partial($options['macrosFileName']);
      }

      return parent::getCompiler();
    }
}

