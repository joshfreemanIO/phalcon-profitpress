<?php

namespace ProfitPress\Blog\Controllers;

use Phalcon\Tag as Tag,
    ProfitPress\Blog\Models\Posts as Posts,
    ProfitPress\Blog\Models\Users as Users,
    ProfitPress\Blog\Models\Categories as Categories,
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
    public function showAction()
    {

        $condition = 'id = :id:';
        $bind = array('id' => $this->dispatcher->getParam(0));

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

    public function createAction()
    {

    	Tag::setTitle("Create Blog Post");

        $form = new \ProfitPress\Blog\Forms\PostForm();

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $post = new Posts();

            $post->title = $this->request->getPost('title');

            $post->slug = $this->request->getPost('permalink');

            $post->content = $this->request->getPost('content');

            $post->created = $post->createCurrentTimeStamp();

            if ($this->request->getPost('publish') === null) {
                $post->published = 0;
            }

            $post->users_id =1;
            $post->categories_id =2;

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

        $this->view->form = $form;
    }

    public function editAction()
    {

    }

    public function workForm(\ProfitPress\Blog\Forms\PostForm $form)
    {

    }

    public function deleteAction($slug)
    {
    }

}