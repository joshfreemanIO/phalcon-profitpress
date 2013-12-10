<?php

namespace ProfitPress\Posts\Controllers;

use Phalcon\Tag as Tag,
    ProfitPress\Posts\Models\Posts as Posts,
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

    /**
     * Let’s read that record from the database. When using MySQL adapter,
     * like we do in this tutorial, $slug variable will be escaped so
     * we don’t have to deal with it.
     */
    public function viewAction($post_id)
    {

        $condition = 'id = :id:';
        $bind = array('id' => $post_id);

        $post = Posts::findFirst(array($condition, 'bind' => $bind));

        if ($post === false) {
            $this->dispatcher->forward(array(
                'module' => 'site',
                'controller' => 'error',
                'action' => 'error404',
            ));
        }

        $this->view->setVar('post', $post);
    }

    public function createAction($post_type)
    {

    	Tag::setTitle("Create Blog Post");

        $post = new Posts();

        $form = new \ProfitPress\Posts\Forms\PostForm($post);

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $form->bind($this->request->getPost(), $post);

            if ($post->save()) {
                $this->flash->success("\"$post->get('title')\" was successfully updated!");

                $permalinkModule = new PermalinkModule();
                $permalinkModule->registerAutoloaders();

                PermalinkController::createPermalink($this->request->getPost('permalink'),'blog','posts','show',$post->id);

                $response = new \Phalcon\Http\Response();
                return $response->redirect("dashboard");
            } else {
                foreach ($post->getMessages() as $message) {

                    $this->flash->error($message);
                }
            }
        }

        $this->view->pick('posts/form');

        $this->view->form = $form;
    }

    public function editAction($post_id)
    {

        Tag::setTitle("Edit Post");

        $condition = 'post_id = :post_id:';
        $bind = array('post_id' => $post_id);

        $post = Posts::findFirst(array($condition, 'bind' => $bind));

        $form = new \ProfitPress\Posts\Forms\PostForm($post);

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $form->bind($this->request->getPost(), $post);

            if ($post->save()) {
                $this->flash->success("You have created a new blog post!");

                $permalinkModule = new PermalinkModule();
                $permalinkModule->registerAutoloaders();

                PermalinkController::createPermalink($this->request->getPost('permalink'),'blog','posts','show',$post->id);

                $response = new \Phalcon\Http\Response();
                return $response->redirect("dashboard");
            } else {
                foreach ($post->getMessages() as $message) {

                    $this->flash->error($message);
                }
            }
        }
        $this->view->pick('posts/form');
        $this->view->form = $form;
    }

    public function workForm(\ProfitPress\Posts\Forms\PostForm $form)
    {

    }

    public function deleteAction($slug)
    {
    }

}