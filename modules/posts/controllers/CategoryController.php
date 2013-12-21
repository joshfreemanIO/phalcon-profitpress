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
