<?php

namespace ProfitPress\Posts\Models;

use Phalcon\Mvc\Model\Validator\PresenceOf;

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

    public function validateModel()
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
