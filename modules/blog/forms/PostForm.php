<?php

namespace ProfitPress\Blog\Forms;

use \Phalcon\Forms\Element\Hidden,
    \Phalcon\Forms\Element\Submit,
    \Phalcon\Forms\Element\Text,
    \Phalcon\Forms\Element\TextArea,
    \Phalcon\Forms\Element\Check;

use \Phalcon\Validation\Validator\Regex,
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
        $this->add($title);

        $permalink = new Text("permalink");
        $permalink->setLabel("Permanent Url");
        $permalink->addValidator(new Regex(array(
            'message' => 'Only use letters, numbers, underscores, or hyphens',
            'pattern' => '/[a-zA-Z0-9\_\-]+/',
            )));
        $this->add($permalink);

        $content = new TextArea('content');
        $content->setLabel('Content');
        $content->setAttribute('id', 'editor');
        $content->addValidator(new PresenceOf(array('message' => 'Please, write something!')));
        $this->add($content);


        $allow_comments = new Check('allow_comments', array('value' => 1, 'checked' => 'checked'));
        $allow_comments->setLabel('Allow Comments for this Post');
        $this->add($allow_comments);


        $authorize_comments = new Check('authorize_comments', array('value' => 1));
        $authorize_comments->setLabel('Every Comment Must be Authorized');
        $this->add($authorize_comments);


        $save_draft = new Submit('Save in Drafts', array('name' => 'save_draft'));
        $this->add($save_draft);

        $publish = new Submit('Create New Post', array('name' => 'publish'));
        $this->add($publish);

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
