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
class CategoryForm extends \ProfitPress\Components\BaseForm
{

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');


    public function initialize($entity = null)
    {

        $name = new Text("name");
        $name->setLabel("Category Name");
        $name->addValidator(new PresenceOf(array('message' => 'The category name cannot be empty')));
        $name->setAttribute('class', 'form-control');

        $submit = new Submit('Create New Category');
        $submit->setAttribute('class', 'btn btn-block btn-info');
        $submit->setAttribute('data-ajax-route', '/posts/createcategory');
        $submit->setAttribute('data-ajax-input', 'category_name');

        $this->add($name);
        $this->add($submit);

    }
}