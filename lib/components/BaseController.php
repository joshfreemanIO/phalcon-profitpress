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

/**
 * BaseController provides basic methods required by child controllers
 *
 * This controller is abstract, therefore it cannot be instantiated
 * directly and must be extended instead.
 *
 * @category ProfitPress
 * @package  ProfitPress\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
abstract class BaseController extends Controller
{

    use \ProfitPress\Traits\FlashMessages;


    public function beforeExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {

    }

    public function afterExecuteRoute(\ProfitPress\Dispatcher\Dispatcher $dispatcher)
    {
        Tag::appendTitle(' | ProfitPress.com');

    }

    protected function initialize()
    {
        Tag::appendTitle('ProfitPress | ');

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

    protected function validateModelAndFlashMessages($model)
    {
        $validation_successful = $model->validation();

        if ($validation_successful !== true) {
            $this->flashMessages($model->getMessages(), 'error');
            return false;
        }

        return true;
    }

    protected function validateFormAndFlashMessages($form)
    {
        $validation_successful = $form->isValid();

        if ($validation_successful !== true) {
            $this->flashMessages($form->getMessages(), 'error');
            return false;
        }

        return true;
    }



    public function formAndModelValidationAndSaving($form, $model)
    {

    }
}