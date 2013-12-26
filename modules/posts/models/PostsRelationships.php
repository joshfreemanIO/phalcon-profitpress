<?php

/**
 * Contains the PostsRelationships class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Posts\Models
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Posts\Models;

use Phalcon\Mvc\Model\Validator\PresenceOf;


/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  ProfitPress\Posts\Models
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class PostsRelationships extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    public $post_id;

    /**
     * @var string
     *
     */
    public $category_id;

    public function initialize()
    {
        $this->hasManyToMany(
           'post_id',
           '\ProfitPress\Posts\Models\Posts',
           'post_id',
           'category_id',
           '\ProfitPress\Posts\Models\PostsCategories',
           'category_id'
        );
    }

    public function validation()
    {

        $this->validate(new PresenceOf(
            array(
                'field' => 'post_id',
                'message' => 'Category name cannot be empty when adding a new category'
                )

            ));

        $this->validate(new PresenceOf(
            array(
                'field' => 'category_id',
                'message' => 'Category name cannot be empty when adding a new category'
                )

            ));

        if ($this->validationHasFailed() == true) {
          return false;
        }
    }

    public function addRelationship($post_id, $category_id) {

        $this->post_id = $post_id;

        $this->category_id = $category_id;

        if ( !$this->validateModel() || !$this->save() ) {

            foreach ($this->getMessages() as $message) {

                $this->flash->error($message);
            }
        }
    }
}
