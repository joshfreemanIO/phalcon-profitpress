<?php


class Categories extends \Phalcon\Mvc\Model
{

    /**
     * @var integer
     *
     */
    public $id;

    /**
     * @var string
     *
     */
    public $name;

    /**
     * @var string
     *
     */
    public $slug;


    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->hasMany("id", "Posts", "categories_id");
    }

}
