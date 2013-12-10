<?php

namespace ProfitPress\Posts\Forms;

use ProfitPress\Posts\Models\Posts as PostsModel;

use Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Check;

use Phalcon\Validation\Validator\Regex,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;

class PostForm extends \ProfitPress\Components\BaseForm
{

    public function __construct(PostsModel $entity = null)
    {

        parent::__construct($entity);

    }

    public function initialize(PostsModel $entity = null)
    {

        if (!empty($entity)) {
           $this->setEntity($entity);
        }

        $title = new Text('title', array('data-copy-source' => 'title'));
        $title->setLabel('Title');
        $title->addValidator(new PresenceOf(array('message' => 'Title Required')));
        $this->add($title);


        $permalink = new Text('permalink',array('data-copy-target' => 'title', 'data-copy-linkify' => 'true'));
        $permalink->setLabel('Permanent Url');
        $permalink->addValidator(new Regex(array(
            'message' => 'Only use letters, numbers, underscores, or hyphens',
            'pattern' => '/[a-zA-Z0-9\_\-]+/',
            )));

        $this->add($permalink);


        $content = new TextArea('content');
        $content->setLabel('Content');
        $content->addValidator(new PresenceOf(array('message' => 'Please, write something!')));
        $this->add($content);


        $allow_comments = new Check('allow_comments', array('value' => 1, 'checked' => 'checked'));
        $allow_comments->setLabel('Allow Comments for this Post');
        $allow_comments->setUserOption('form_group_attributes', array('class' => 'col-md-6'));
        $allow_comments->setUserOption('label_attributes', array('class' => 'col-md-8'));
        $allow_comments->setUserOption('element_wrapper_attributes', array('class' => 'col-md-4'));
        $this->add($allow_comments);


        $authorize_comments = new Check('authorize_comments', array('value' => 1));
        $authorize_comments->setLabel('Every Comment Must be Authorized');
        $authorize_comments->setUserOption('form_group_attributes', array('class' => 'col-md-6'));
        $authorize_comments->setUserOption('label_attributes', array('class' => 'col-md-8'));
        $authorize_comments->setUserOption('element_wrapper_attributes', array('class' => 'col-md-4'));
        $this->add($authorize_comments);


        $save_draft = new Submit('Save in Drafts', array('name' => 'save_draft', 'class' => 'btn btn-block btn-primary'));
        $save_draft->setUserOption('element_attributes', array('class' => 'btn btn-block btn-info'));
        $save_draft->setUserOption('no_element_wrapper', true);
        $save_draft->setUserOption('no_label', true);
        $this->add($save_draft);


        $publish = new Submit('Publish New Post', array('name' => 'publish', 'class' => 'btn btn-block btn-success'));
        $publish->setUserOption('element_attributes', array('class' => 'btn btn-block btn-success'));
        $publish->setUserOption('no_element_wrapper', true);
        $publish->setUserOption('no_label', true);
        $this->add($publish);

        $this->advancedOptions();
        $this->addExcerpt();

        $this->registerAssets();
    }


    protected function advancedOptions()
    {
        $head_title = new Text("head-title", array('data-copy-source' => 'head-title', 'data-copy-target' => 'title','data-copy-linkify' => 'false'));
        $head_title->setUserOption('label_attributes', array('class' => 'control-label col-sm-4'));
        $head_title->setUserOption('element_wrapper_attributes', array('class' => 'col-md-8'));
        $head_title->setUserOption('form_group_attributes', array('class-append' => 'col-md-8'));

        $head_title->setLabel('Title Tag');
        $this->add($head_title);

        $head_description = new Text("head-description", array('data-copy-source' => 'head-description'));
        $head_description->setUserOption('label_attributes', array('class' => 'control-label col-sm-4'));
        $head_description->setUserOption('element_wrapper_attributes', array('class' => 'col-md-8'));
        $head_description->setUserOption('form_group_attributes', array('class-append' => 'col-md-8'));
        $head_description->setLabel('Meta Description');
        $this->add($head_description);
    }

    protected function addExcerpt()
    {
        $excerpt = new Text("excerpt", array('data-copy-source' => 'excerpt'));
        $excerpt->setUserOption('element_wrapper_attributes', array('class' => 'col-md-12'));
        $excerpt->setUserOption('form_group_attributes', array('class-append' => 'col-md-12'));
        $excerpt->setUserOption('no_label', true);
        $excerpt->setUserOption('no_element_wrapper', true);
        $this->add($excerpt);
    }

    protected function registerAssets()
    {
        $this->assets->collection('head')
            // ->addJs('//tinymce.cachefly.net/4.0/tinymce.min.js', false);
            ->addJs('lib/tinymce/js/tinymce/tinymce.min.js');

        $this->assets->collection('footer')
            ->addJs('js/permalink.js')
            ->addJs('js/advanced.js');

    }
}
