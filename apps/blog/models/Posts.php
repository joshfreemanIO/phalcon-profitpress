<?php

namespace ProfitPress\Blog\Models;

class Posts extends \Phalcon\Mvc\Model
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
    public $title;

    /**
     * @var string
     *
     */
    public $slug;

    /**
     * @var string
     *
     */
    public $content;

    /**
     * @var string
     *
     */
    public $created;

    /**
     * @var integer
     *
     */
    public $users_id;

    /**
     * @var integer
     *
     */
    public $categories_id;


    /**
     * Initializer method for model.
     */
    public function initialize()
    {
        $this->belongsTo("users_id", "Users", "id");
        $this->belongsTo("categories_id", "Categories", "id");
    }

}
