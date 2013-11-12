<?php

namespace ProfitPress\Blog\Controllers;

use \Phalcon\Mvc\Model\Criteria,
    \ProfitPress\Blog\Models\Posts as Posts,
    \ProfitPress\Blog\Models\Users as Users,
    \ProfitPress\Blog\Models\Categories as Categories;

class CategoriesController extends \ProfitPress\Components\BaseController
{

    public function indexAction()
    {
        $this->session->conditions = null;
    }

    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Categories", $_POST);
            $this->session->conditions = $query->getConditions();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            if ($numberPage <= 0) {
                $numberPage = 1;
            }
        }

        $parameters = array();
        if ($this->session->conditions) {
            $parameters["conditions"] = $this->session->conditions;
        }
        $parameters["order"] = "id";

        $categories = Categories::find($parameters);
        if (count($categories) == 0) {
            $this->flash->notice("The search did not find any categories");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $categories,
            "limit"=> 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $categories = Categories::findFirst(array(
                'id = :id:',
                'bind' => array('id' => $id)
            ));
            if (!$categories) {
                $this->flash->error("The category was not found");
                return $this->dispatcher->forward(array(
                    "controller" => "categories",
                    "action" => "index"
                ));
            }
            $this->view->setVar("id", $categories->id);

            Tag::displayTo("id", $categories->id);
            Tag::displayTo("name", $categories->name);
            Tag::displayTo("slug", $categories->slug);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $categories = new Categories();
        $categories->id = $this->request->getPost("id");
        $categories->name = $this->request->getPost("name");
        $categories->slug = $this->request->getPost("slug");
        if (!$categories->save()) {
            foreach ($categories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "new"
            ));
        } else {
            $this->flash->success("The category was created successfully");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $category = Categories::findFirst(array(
            'id = :id:',
            'bind' => array('id' => $this->request->getPost("id"))
        ));
        if (!$category) {
            $this->flash->error("The category does not exist");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        $categories->id = $this->request->getPost("id");
        $categories->name = $this->request->getPost("name");
        $categories->slug = $this->request->getPost("slug");

        if (!$categories->save()) {
            foreach ($categories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "edit",
                "params" => array($categories->id)
            ));
        } else {
            $this->flash->success("categories was updated successfully");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

    }

    public function deleteAction($id)
    {

        $categories = Categories::findFirst(array(
            'id = :id:',
            'bind' => array('id' => $id)
        ));
        if (!$categories) {
            $this->flash->error("The category was not found");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }

        if (!$categories->delete()) {
            foreach ($categories->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "search"
            ));
        } else {
            $this->flash->success("The category was deleted");
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "index"
            ));
        }
    }

}
