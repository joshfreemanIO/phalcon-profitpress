<?php

// /**
//  * Contains the PostsCategoryForm class
//  *
//  * @category  ProfitPress
//  * @package   ProfitPress\Posts\Forms
//  * @author    Josh Freeman <jdfreeman@satx.rr.com>
//  * @copyright 2013 Help Yourself Today LLC
//  * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
//  * @version   1.0.0
//  * @link      http://documentation.profitpress.com
//  * @since     File available since Release 1.0.0
//  */

// namespace ProfitPress\Posts\Forms;

// use \Phalcon\Forms\Element\Hidden,
//     \Phalcon\Forms\Element\Submit,
//     \Phalcon\Forms\Element\Text,
//     \Phalcon\Forms\Element\TextArea,
//     \Phalcon\Validation\Validator\Regex,
//     \Phalcon\Validation\Validator\PresenceOf,
//     \Phalcon\Validation\Validator\Identical;


// /**
//  * [Short description]
//  *
//  * [Long description]
//  *
//  * @category ProfitPress
//  * @package  ProfitPress\Posts\Forms
//  * @author   Josh Freeman <jdfreeman@satx.rr.com>
//  * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
//  * @version  1.0.0
//  * @link     http://developer.profitpress.com
//  * @since    1.0.0
//  */
// class PostsCategoryForm extends \ProfitPress\Components\BaseForm
// {

//     public $noLabel = array(
//         'Phalcon\Forms\Element\Hidden',
//         'Phalcon\Forms\Element\Submit');


//     public function initialize($entity = null)
//     {

//         $name = new Text("name");
//         $name->setLabel("Category Name");
//         $name->addValidator(new PresenceOf(array('message' => 'Title Required')));

//         $submit = new Submit('Create New Category');

//         $this->add($name);
//         $this->add($submit);

//         $this->registerAssets();
//     }

//     protected function registerAssets()
//     {
//         // $this->assets->collection('head')
//             // ->addJs('//tinymce.cachefly.net/4.0/tinymce.min.js', false);
//             // ->addJs('lib/tinymce/js/tinymce/tinymce.min.js');

//         $this->assets->collection('footer')
//             ->addJs('js/permalink.js');

//     }

//     protected function getArrayedInputs($input)
//     {
//         $pattern = "/^$input\[.*\]$/";

//         $elements = $this->getElements();

//         return preg_grep($pattern, array_keys($elements));
//     }

//     public function renderCheckboxList($input)
//     {

//         $list = $this->getArrayedInputs($input);

//         foreach ($list as $value) {
//             $this->renderCheckbox($this->get($value));
//         }
//     }
// }
