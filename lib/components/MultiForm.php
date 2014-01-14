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

use Phalcon\Mvc\User\Component;

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

	protected $_valid = array();

	protected $_data = array();

	public function __construct()
	{
		if ($this->getDI()->getRequest()->isPost()) {
			$this->_data = $this->request->getPost();
		}
	}

	public function addForm($form_name, $form)
	{
		if (is_subclass_of($form, $this->_base_form_class_name)) {
			$this->_forms[$form_name] = $form;
		} else {
			throw new Exception(get_class($form) . " does not extend ". $this->_base_form_class_name);
		}

	}

	public function __get($form_name)
	{
		if (array_key_exists($form_name, $this->_forms)) {
			return $this->_forms[$form_name];
		} else {
			throw new Exception("'$form_name' does not exist in the $_forms array");
		}
	}

	public function isValid()
	{
		foreach ($this->_forms as $form_name => $form) {

			if ($form->isValid($this->_data)) {
				$this->_valid[$form_name] = true;
			} else {
				$this->_valid[$form_name] = false;
				array_merge($this->_messages, $form->getMessages());
			}
		}

		if (in_array(false, $this->_valid)) {
			return false;
		} else {
			return true;
		}
	}

	public function getMessages()
	{
		return $this->_messages;
	}

}