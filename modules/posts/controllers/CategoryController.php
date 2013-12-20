<?php

namespace ProfitPress\Posts\Controllers;

use \Phalcon\Mvc\Model\Criteria,
    \ProfitPress\Posts\Models\Posts as Posts,
    \ProfitPress\Posts\Models\Users as Users,
    \ProfitPress\Posts\Models\Categories as Categories;

class CategoryController extends \ProfitPress\Components\BaseController
{

    public function addAction()
    {

        $content = array();

        $response = new \Phalcon\Http\Response();

        $response->setStatusCode(200, 'OK');

        if (!$this->request->isAjax()) {
           
            $content['errors'][] = "Invalid Ajax Request";
        }

        $name = $this->request->getPost('value');
        $result = $this->addCategory($name);

        if ($result !== true) {

            foreach ($result as $error) {
                $content['errors'][] = $error;
            }
        }

        $content['name'] = $name;

        if (!empty($content['errors'])) {
            $response->setStatusCode(409, 'Conflict: Category Errors');
        }

        $response->setContentType('application/json', 'UTF-8');
        $response->setContent(json_encode($content));

        $this->view->disable;

        return $response;
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}
