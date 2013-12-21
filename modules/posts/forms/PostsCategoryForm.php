<?php

/**
 * Contains the PostsCategoryForm class
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

class PostsCategoryForm extends \ProfitPress\Components\BaseForm
{

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function __construct()
    {
        parent::__construct();

    }
    public function initialize($entity = null)
    {

        if (!empty($entity)) {
           $this->setEntity($entity);
        }

        $name = new Text("name");
        $name->setLabel("Category Name");
        $name->addValidator(new PresenceOf(array('message' => 'Title Required')));

        $content = new TextArea('content');
        $content->setLabel('Content');
        $content->setAttribute('id', 'editor');
        // $content->addValidator(new PresenceOf(array('message' => 'Please, write something!')));

        $submit = new Submit('Create New Category');

        $this->add($title);
        $this->add($permalink);
        $this->add($content);
        $this->add($submit);

        $this->registerAssets();
    }

    protected function registerAssets()
    {
        $this->assets->collection('head')
            // ->addJs('//tinymce.cachefly.net/4.0/tinymce.min.js', false);
            ->addJs('lib/tinymce/js/tinymce/tinymce.min.js');

        $this->assets->collection('footer')
            ->addJs('js/permalink.js');

        $this->assets->addCss('aloha/css/aloha.css');
    }
}
