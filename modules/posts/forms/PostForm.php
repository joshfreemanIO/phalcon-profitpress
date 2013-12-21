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
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Check;

use Phalcon\Validation\Validator\Regex,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical;

class PostForm extends \ProfitPress\Components\BaseForm
{

    public function __construct(PostsModel $post_entity = null, PostsCategoriesModel $post_categories_entity = null)
    {

        parent::__construct($post_entity,$post_categories_entity);

    }

    public function initialize(PostsModel $post_entity = null, PostsCategoriesModel $post_categories_entity = null)
    {
        // if (empty($post_entity)) {
        //     $post_entity = new PostsModel();
        // }

        // if (empty($post_categories_entity)) {
        //     $post_entity = new PostsCategoriesModel();
        // }

        if (!empty($entity)) {
           $this->setEntity($post_entity);//,array($post_entity, $post_categories_entity));
        }

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


        $content = new TextArea('content', array('data-markdown-source' => 'content'));
        // $content->setLabel('Content');
        $content->addValidator(new PresenceOf(array('message' => 'Please, write something!')));
        $content->setUserOption('no_label', true);
        $content->setAttribute('class', 'form-control text-height');
        $content->setUserOption('no_element_wrapper', true);
        // $content->setUserOption('form_group_attributes', array('class' => 'col-md-12'));
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


        $category_name = new Text('category_name');
        $category_name->setAttribute('placeholder', 'Category Name');
        $category_name->setAttribute('class', 'form-control');

        \ProfitPress\Posts\Models\PostsCategories::addFormElements($this);

        $category_name->addValidator(new PresenceOf(array('message' => 'Please, write something!')));

        $this->add($category_name);


        $add_category = new Submit('Add Category');

        $add_category->setAttribute('name', 'add_category');
        $add_category->setAttribute('class', 'btn btn-info');
        $add_category->setAttribute('type', 'button');

        $add_category->setAttribute('data-ajax-route', '/posts/createcategory');
        $add_category->setAttribute('data-ajax-input', 'category_name');

        $this->add($add_category);


        $publish = new Submit('Publish New Post');

        $publish->setAttribute('name', 'submit');
        $publish->setAttribute('class', 'btn btn-block btn-success');

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
            // ->addJs('//tinymce.cachefly.net/4.0/tinymce.min.js', false);
            // ->addCss('lib/jquery-custom-scrollbar/jquery.custom-scrollbar.css')
            ->addJs('lib/tinymce/js/tinymce/tinymce.min.js');

        $this->assets->collection('footer')
            ->addJs('js/markdown.js')
            ->addJs('js/permalink.js')
            ->addJs('js/ajax-PostForm.js')
            ->addJs('js/advanced.js')
            ->addJs('js/shiv.placeholder.js')
            ->addJs('lib/jquery-custom-scrollbar/jquery.custom-scrollbar.js');

    }

    protected function getArrayedInputs($input)
    {
        $pattern = "/^$input\[.*\]$/";

        $elements = $this->getElements();

        return preg_grep($pattern, array_keys($elements));
    }

    public function renderCheckboxList($input)
    {

        $list = $this->getArrayedInputs($input);

        foreach ($list as $value) {
            $this->renderCheckbox($this->get($value));
        }
    }
}
