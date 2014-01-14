<?php

/**
 * Contains the PostsController class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Posts\Controllers
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Posts\Controllers;

use ProfitPress\Posts\Forms\PostForm,
    ProfitPress\Posts\Forms\PostsCategoryForm;

use ProfitPress\Components\MultiForm;

use Phalcon\Tag,
    ProfitPress\Posts\Models\Posts,
    ProfitPress\Posts\Models\PostsCategories,
    ProfitPress\Posts\Models\Users,
    ProfitPress\Posts\Models\Categories,
    ProfitPress\Permalink\PermalinkModule,
    ProfitPress\Permalink\Controllers\PermalinkController;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Posts\Controllers
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class PostsController extends \ProfitPress\Components\BaseController
{

    public function onConstruct()
    {
        $this->view->setLayoutsDir('../../site/views/layouts/');
        $this->view->setLayout('layout-admin');

    }

	/**
	 * We simply pass all the posts created to the view
	 */
	public function viewallAction()
    {
    	$page = 1;

        if (preg_match('/^\d+$/', $this->dispatcher->getParam(0)) === 1)
            $page = $this->dispatcher->getParam(0);

        //Passing a resultset as data
        $posts = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data"  => Posts::find(),
                "limit" => 10,
                "page"  => $page,
            )
        );

        $this->view->posts_paginater = $posts->getPaginate();
    }


    public function viewAction($post_identifier)
    {

        if (preg_match('/^\d+$/', $post_identifier)) {

            $condition = 'post_id = :post_id:';
            $bind = array('post_id' => $post_identifier);

        } else {

            $condition = 'permalink = :permalink:';
            $bind = array('permalink' => $post_identifier);

        }

        $post = Posts::findFirst(array($condition, 'bind' => $bind));

        if ($post === false) {
            $this->dispatcher->forward(array(
                'module' => 'site',
                'controller' => 'error',
                'action' => 'error404',
            ));
        }

        $template = $post->get('template');

        if (!empty($template) || $template === 'default') {
            $this->view->pick('posts/templates/'.$template);
        }


        $this->view->setVar('post', $post);
    }

    public function postManager(Posts $posts_model, PostsCategories $posts_categories_model)
    {
        $post_form = new PostForm;

        $post_form->bindData($this->request->getPost(), $posts_model);

        $posts_categories_form = new PostsCategoriesForm;

        $posts_categories_form->bindData($this->request->getPost(), $posts_categories_model);

        if (!$post_form->isValid()) {
            $this->flashMessages($post_form, 'error');
        }

        if (!$posts_categories_form->isValid()) {
            $this->flashMessages($post_form, 'error');
        }

        $posts_categories_form->isValid();
    }

    public function createnAction($post_type)
    {

    	Tag::setTitle("Create Blog Post");

        $post = new Posts();

        $form = new PostForm($post);

        $form = $this->actBasedUponSubmitType($post, $form);

        $this->view->footer_editor = true;

        $this->view->pick(array('posts/form', 'layout-admin'));

        $this->view->form = $form;
    }

    public function editAction($post_id)
    {

        Tag::setTitle("Edit Post");

        $condition = 'post_id = :post_id:';
        $bind = array('post_id' => $post_id);

        $post = Posts::findFirst(array($condition, 'bind' => $bind));

        $form = new PostForm($post);

        $form = $this->actBasedUponSubmitType($post, $form);

        $this->view->pick('posts/form');
        $this->view->footer_editor = true;

        $this->view->form = $form;

    }

    protected function actBasedUponSubmitType(Posts $post, PostForm $form)
    {
        $add_category = $this->request->getPost('add_category');

        if ($this->request->isAjax()) {
            $this->validateAjax($form);
        }

        if (!empty($add_category)) {
            $this->addCategory($this->request->getPost('category_name'));
        }

        $submit = $this->request->getPost('submit');

        if (!empty($submit)) {
            $form = $this->managePostModelAndForm($post, $form);
        }

        return $form;
    }

    public function createcategoryAction()
    {
        $content = array();

        $response = new \Phalcon\Http\Response();

        $response->setStatusCode(200, 'OK');

        if (!$this->request->isAjax()) {

            $content['error'][] = "Invalid Ajax Request";
        }

        $name = $this->request->getPost('value');
        $result = $this->addCategory($name);

        if ($result !== true) {

            foreach ($result as $error) {
                $content['error'][] = $error;
            }
        }

        $content['name'] = $name;

        $response->setContentType('application/json', 'UTF-8');
        $response->setContent(json_encode($content));

        $this->view->disable;

        return $response;
    }


    protected function managePostModelAndForm(Posts $post, PostForm $form)
    {

        if ( !$this->request->isPost() ) {
            return $form;
        }

        $form->bind($this->request->getPost(), $post);

        $form_is_valid = $this->validateForm($form);

        if ( !$form_is_valid ) {
            return $form;
        }

        $categories = $this->request->getPost('category');

        if ($categories) {

            foreach ($categories as $key => $value) {
                // code...
            }
        }

        $add_category = $this->request->getPost('add_category');

        if (!empty($add_category)) {
            $this->addCategory($this->request->getPost('category_name'));

        }

        if ( !$post->save() ) {

            foreach ($post->getMessages() as $message) {

                $this->flash->error($message);
            }

            return $form;

        } else {

            $title = $post->get('title');
            $this->flash->success("$title was successfully updated!");

            // $permalinkModule = new PermalinkModule();
            // $permalinkModule->registerAutoloaders();

            // PermalinkController::createPermalink($this->request->getPost('permalink'),'blog','posts','show',$post->id);
            // $this->view->disable();
            // $response = new \Phalcon\Http\Response();
            $this->response->redirect("dashboard");
        }

    }

    // public function validate

    public function addCategory($name)
    {
        $posts_category = new PostsCategories;

        $posts_category->set('name', $name);

        if (!$posts_category->validateModel() && !$posts_category->save()) {

            $messages = array();
            foreach ($posts_category->getMessages() as $message) {

                $messages[] = $message;
            }
            return $messages;
        }

        return true;
    }

    public function fileuploadAction()
    {
        if ($this->request->hasFiles() == true) {

            foreach ($this->request->getUploadedFiles() as $file){

                $url = new \Phalcon\Mvc\Url();

                $pub_path = 'files/test/' . preg_replace('/[^a-zA-Z0-9\-\_\:\.]/', '_', $file->getName());
                $markdown = '![Describe Your Image](';
                $markdown .= '/' . $pub_path;
                $markdown .= ' "Title Your Image")';

                $file_details['path'] = $pub_path;
                $file_details['markdown'] = $markdown;

                $content[] = $file_details;

                $file->moveTo( __PUBDIR__ . $pub_path);
            }

            $response = new \Phalcon\Http\Response();

            $response->setStatusCode(200, 'OK');

            $response->setContentType('application/json', 'UTF-8');
            $response->setContent(json_encode($content));

            return $response;
        }
    }

    public function createAction($post_model = null, $post_category_model = null)
    {

        $form = new MultiForm;

        $post_model = new Posts;
        $post_category_model = new PostsCategories;

        $form->addForm('post', new PostForm($post_model));
        $form->addForm('post_category', new PostsCategoryForm($post_category_model));

        if ($this->request->isPost()) {
            if ($form->isValid()) {

            } else {
                $this->flashMessages( $form, 'error');
            }
        }

        $this->view->form = $form;
        $this->view->pick(array('posts/formdemo', 'layout-admin'));
    }


}