<?php

/**
 * Contains the PostForm class
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

use ProfitPress\Posts\Models\Posts as PostsModel,
    ProfitPress\Posts\Models\PostsCategories as PostsCategoriesModel;

use Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Submit,
    Phalcon\Forms\Element\Date,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Check;

use Phalcon\Validation\Validator\Regex,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;


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
class PostForm extends \ProfitPress\Components\BaseForm
{

    public function initialize(PostsModel $post_entity = null)
    {

        $title = new Text('title');

        $title->setAttribute('placeholder', 'Title');
        $title->setAttribute('data-copy-source', 'title');

        $title->setUserOption('no_label', true);
        $title->setUserOption('element_wrapper_attributes', array('class' => 'col-md-12'));
        $title->addValidator(new PresenceOf(array('message' => 'Title Required')));
        $this->add($title);


        $permalink = new Text('permalink');

        $permalink->setAttribute('class', 'form-control');
        $permalink->setAttribute('data-copy-target', 'title');
        $permalink->setAttribute('data-copy-linkify', 'true');
        $permalink->setAttribute('data-ajax-validate-route', '/post/validate');
        $permalink->setAttribute('data-ajax-validate-model', get_class($post_entity));
        $permalink->setAttribute('data-copy-target', 'title');

        $permalink->setUserOption('label_attributes', array('class' => 'col-md-6 small text-right'));
        // $permalink->setUserOption('element_wrapper_attributes', array('class' => 'col-md-6'));
        $permalink->setUserOption('no_label', true);
        $permalink->setUserOption('no_element_wrapper', true);
        // $permalink->setUserOption('element_wrapper_attributes', array('class' => 'col-md-6'));
        $permalink->addValidator(new Regex(array(
            'message' => 'Only use letters, numbers, underscores, or hyphens',
            'pattern' => '/[a-zA-Z0-9\_\-]+/',
            )));

        $this->add($permalink);


        $markdown = new TextArea('markdown', array('data-markdown-source' => 'content'));
        // $markdown->setLabel('markdown');
        $markdown->addValidator(new PresenceOf(array('message' => 'Please, write something!')));
        $markdown->setUserOption('no_label', true);
        $markdown->setAttribute('class', 'form-control text-height');
        $markdown->setUserOption('no_element_wrapper', true);
        // $markdown->setUserOption('form_group_attributes', array('class' => 'col-md-12'));
        $this->add($markdown);

        $content = new Hidden('content');
        $content->setAttribute('data-copy-target', 'rendered-markdown');
        $content->setAttribute('data-copy-html', 'true');
        $this->add($content);

        $allow_comments = new Check('allow_comments', array('value' => 1, 'checked' => 'checked'));
        $allow_comments->setLabel('Allow Comments for this Post');
        $allow_comments->setUserOption('form_group_attributes', array('class' => 'col-md-6'));
        $allow_comments->setUserOption('label_attributes', array('class' => 'col-md-8'));
        $allow_comments->setUserOption('element_wrapper_attributes', array('class' => 'col-md-4'));
        $this->add($allow_comments);

        $publish_date = new Date('publish_date');
        $publish_date->setLabel("Future Publish Date");
        $this->add($publish_date);


        $authorize_comments = new Check('authorize_comments', array('value' => 1));
        $authorize_comments->setLabel('Every Comment Must be Authorized');
        $authorize_comments->setUserOption('form_group_attributes', array('class' => 'col-md-6'));
        $authorize_comments->setUserOption('label_attributes', array('class' => 'col-md-8'));
        $authorize_comments->setUserOption('element_wrapper_attributes', array('class' => 'col-md-4'));
        $this->add($authorize_comments);




        $category_name = new Text('category_name');
        $category_name->setAttribute('placeholder', 'Category Name');
        $category_name->setAttribute('class', 'form-control');

        // \ProfitPress\Posts\Models\PostsCategories::addFormElements($this);

        // $category_name->addValidator(new PresenceOf(array('message' => 'Please, write something!')));

        $this->add($category_name);

        $save_draft = new Submit('save_draft', array( 'class' => 'btn btn-block btn-block-no-margin btn-primary'));
        $save_draft->setAttribute('value', 'Save in Drafts');
        $save_draft->setUserOption('element_attributes', array('class' => 'btn btn-block btn-info'));
        $save_draft->setUserOption('no_element_wrapper', true);
        $save_draft->setUserOption('no_label', true);
        $this->add($save_draft);

        $publish = new Submit('publish_immediately');
        $publish->setAttribute('value', 'Publish Post');
        $publish->setAttribute('class', 'btn btn-block btn-block-no-margin btn-success');

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

        $this->assets->addCss('lib/jquery-custom-scrollbar/jquery.custom-scrollbar.css');

        $this->assets->collection('head')
            ->addJs('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false);
            // ->addJs('//tinymce.cachefly.net/4.0/tinymce.min.js', false);
            // ->addCss('lib/jquery-custom-scrollbar/jquery.custom-scrollbar.css')
            // ->addJs('lib/tinymce/js/tinymce/tinymce.min.js');

        $this->assets->collection('footer')
            ->addJs('javascript/vendor/shiv.placeholder.js')
            ->addJs('javascript/vendor/markdown.js')
            ->addJs('javascript/vendor/modernizr/modernizr.html5.inputtypes.js')
            ->addJs('javascript/lib/datetimepicker.yepnope.js')
            ->addJs('javascript/vendor/dropzone.js')
            ->addJs('lib/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js')
            ->addJs('javascript/lib/profitpress.js');

            // ->addJs('lib/jquery-custom-scrollbar/jquery.custom-scrollbar.js');

    }
}
