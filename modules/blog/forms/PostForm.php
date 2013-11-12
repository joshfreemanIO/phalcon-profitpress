<?php

namespace ProfitPress\Blog\Forms;

use \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\TextArea,
    \Phalcon\Validation\Validator\Regex,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\Identical;

class PostForm extends \ProfitPress\Components\BaseForm
{

    public $noLabel = array(
        'Phalcon\Forms\Element\Hidden',
        'Phalcon\Forms\Element\Submit');

    public function __construct()
    {
        parent::__construct();

    }
    public function initialize()
    {
        $title = new Text("title");
        $title->setLabel("Title");
        $title->addValidator(new PresenceOf(array('message' => 'Title Required')));

        $permalink = new Text("permalink");
        $permalink->setLabel("Permanent Url");
        $permalink->addValidator(new Regex(array(
            'message' => 'Only use letters, numbers, underscores, or hyphens',
            'pattern' => '/[a-zA-Z0-9\_\-]+/',
            )));

        $content = new TextArea('content');
        $content->setLabel('Content');
        $content->setAttribute('id', 'editer');
        // $content->addValidator(new PresenceOf(array('message' => 'Please, write something!')));

        $submit = new Submit('Create New');

        $this->add($title);
        $this->add($permalink);
        $this->add($content);
        $this->add($submit);
    }
}