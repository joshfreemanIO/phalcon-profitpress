<?php

/**
 * Contains the CategoryController class
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

use \Phalcon\Mvc\Model\Criteria,
    \ProfitPress\Posts\Models\Posts as Posts,
    \ProfitPress\Posts\Models\Users as Users,
    \ProfitPress\Posts\Models\Categories as Categories;

use ProfitPress\Posts\Forms\PostsCategoryForm;

use ProfitPress\Posts\Models\PostsCategories;

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
class CategoryController extends \ProfitPress\Components\BaseController
{

    public function addCategory(PostsCategoryForm $form = null, PostsCategories $model = null)
    {
        if (empty($form)) {
            $form = new PostCategoryForm;
        }

        if (empty($model)) {
            $model = new PostsCategories;
        }

        $messages = array();

        $form->bind($this->request->getPost(), $model);

        if ($form->isValid() ) {

            if ($model->validation() && $model->save()) {

            } else {
                array_merge($messages, $model->getMessages());
            }

        } else {
            $this->flashMessages($form, 'error');
            array_merge($messages, $form->getMessages());
        }

        if ($this->request->isAjax()) {
            return $this->ajaxResponse($model->get('name'), $messages);
        }

        if ($this->request->isPost()) {
            return $this->postResponse($model->get('name'), $messages);
        }

    }

    protected function ajaxResponse($name, $messages = null)
    {
        $response = new \Phalcon\Http\Response();

        $response->setStatusCode(200, 'OK');

        $response->setContentType('application/json', 'UTF-8');

        $content['name'] = $name;

        if (!empty($messages)) {

            $response->setStatusCode(409, 'An Error Has Occurred');

            $content['error'] = $messages;
        }

        $response->setContent(json_encode($content));

        return $response;

    }

    protected function postResponse($name, $messages = null)
    {

    }


    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}
