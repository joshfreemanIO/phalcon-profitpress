<?php

namespace ProfitPress\Posts\Controllers;

use ProfitPress\Posts\Forms\PostForm as PostForm;

use Phalcon\Tag as Tag,
    ProfitPress\Posts\Models\Posts as Posts,
    ProfitPress\Posts\Models\PostsCategories as PostsCategories,
    ProfitPress\Posts\Models\Users as Users,
    ProfitPress\Posts\Models\Categories as Categories,
    ProfitPress\Permalink\PermalinkModule as PermalinkModule,
    ProfitPress\Permalink\Controllers\PermalinkController as PermalinkController;

class PostsController extends \ProfitPress\Components\BaseController
{


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

    public function createAction($post_type)
    {

    	Tag::setTitle("Create Blog Post");

        $post = new Posts();

        $form = new PostForm($post);

        $form = $this->actBasedUponSubmitType($post, $form);

        $this->view->pick('posts/form');

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

        if ( !$form->isValid() ) {

            foreach ($form->getMessages() as $message) {

                $this->flash->error($message);
            }
            
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

        if ( true ) {//!$post->save() ) {

            foreach ($post->getMessages() as $message) {

                $this->flash->error($message);
            }

            return $form;

        } else {
            
            $this->flash->success("\"$post->get('title')\" was successfully updated!");
            
            // $permalinkModule = new PermalinkModule();
            // $permalinkModule->registerAutoloaders();

            // PermalinkController::createPermalink($this->request->getPost('permalink'),'blog','posts','show',$post->id);
            
            $response = new \Phalcon\Http\Response();
            return $response->redirect("dashboard");
        }
        
    }

    public function validate

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

}