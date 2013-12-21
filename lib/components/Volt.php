<?php

/**
 * Contains the Volt class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Components
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

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

