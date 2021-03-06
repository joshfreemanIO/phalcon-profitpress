<?php

/**
 * Contains the CategoryForm class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Posts\Forms
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Posts\Forms;

use \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Forms\Element\Check,
    \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\TextArea,
    \Phalcon\Validation\Validator\Regex,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\Identical;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Posts\Forms
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class PostsCategoryForm extends \ProfitPress\Components\BaseForm
{

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');


    public function initialize($entity = null)
    {

        $entity->getCategories();

        foreach ($entity->getCategories() as $category_id => $name) {

            $check = new Check($name);

            if ($entity->$name === true) {
               $check->setAttribute('checked', 'checked');
            }

            $check->setAttribute('value', $category_id);

            $check->setLabel($name);
            $check->setUserOption('form_group_attributes', array('class' => 'col-md-6'));
            $check->setUserOption('label_attributes', array('class' => 'col-md-8'));
            $check->setUserOption('element_wrapper_attributes', array('class' => 'col-md-4'));
            $this->add($check);

        }
    }
}