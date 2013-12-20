<?php

namespace ProfitPress\Posts\Models;

use Phalcon\Mvc\Model\Validator\PresenceOf;

class PostsCategories extends \ProfitPress\Components\BaseModel
{

    /**
     * @var integer
     *
     */
    public $category_id;

    /**
     * @var string
     *
     */
    public $name;


    public function validateModel()
    {

        $this->validate(new PresenceOf(
            array(
                'field' => 'name',
                'message' => 'Category name cannot be empty when adding a new category'
                )

            ));

        $this->validate(new Uniqueness(
            array(
                'field' => 'name',
                'message' => "\"$this->name\" already exists",
                )

            ));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    public static function addFormElements(\ProfitPress\Posts\Forms\PostForm $form)
    {
        $categories = self::find();

        foreach ($categories as $category) {

            $name = "category[$category->name]";

            $check = new \Phalcon\Forms\Element\Check($name);
            $check->setLabel($category->name);
            $attributes = $check->prepareAttributes(array('value' => $category->category_id), true);
            $check->setAttributes($attributes);
            $form->add($check);
        }
    }
}
