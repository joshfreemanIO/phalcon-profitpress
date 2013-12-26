<?php

/**
 * Contains the BaseForm class
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

use Phalcon\Mvc\Component;

use Phalcon\Forms\Exception;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Components
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class MultiForm extends Component
{

	protected $_base_form_class_name = 'ProfitPress\Components\BaseForm';

	protected $_forms = array();

	public function addForm($form_name, $form)
	{
		if (is_subclass_of($form, $this->_base_form_class_name)) {
			$this->_forms[$form_name] = $form;
		} else {
			throw new Exception(get_class($form) . " does not extend ". $this->_base_form_class_name);
		}
	}

	public function __get($form)
	{
		if (in_array($form_name, $this->_forms)) {
			return $this->_forms[$form_name];
		} else {
			throw new Exception($form_name . " does not exist in the $_forms array");
		}
	}

}