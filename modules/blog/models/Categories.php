<?php

namespace ProfitPress\Blog\Models;

class Categories extends \ProfitPress\Components\BaseModel
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
