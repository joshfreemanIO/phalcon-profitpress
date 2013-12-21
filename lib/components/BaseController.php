<?php

/**
 * Contains the BaseController class
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

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller
{

    public function beforeExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {

    }

    public function afterExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {
        \Phalcon\Tag::appendTitle(' | ProfitPress.com');

    }

    protected function initialize()
    {

        \Phalcon\Tag::appendTitle('ProfitPress | ');

        $this->setCss();
    }

    protected function setCss()
    {
    	$css = \ProfitPress\Site\Models\Settings::getSetting('global_css');

    	if (empty($css)) {
    		$css = 'bootstrap.min.css';
    	}

	    $this->view->css = 'css/'.$css;
    }
}