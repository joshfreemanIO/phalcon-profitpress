<?php

namespace ProfitPress\Posts\Entities;

use ProfitPress\Posts\Models\PostsCategories as PostsCategoriesModel;
use ProfitPress\Posts\Models\Categories as CategoriesModel;

class PostsCategoriesEntity
{

    protected $_post_id;

    protected $_posts_categories = array();

    protected $_categories = array();

    use \ProfitPress\Traits\FlashMessages;

    public function __construct($post_id = 1)
    {
        $this->_post_id = $post_id;
        $this->initialize();
    }

    public function initialize()
    {
        $posts_categories = $this->getPostsCategories();

        $categories = $this->getCategories();

        foreach ($categories as $category_id => $category_name) {

            $set = false;

            if (in_array($category_id, $posts_categories)) {
                $set = true;
            }

            $this->$category_name = $set;
        }
    }

    public function getPostsCategories()
    {

        if (!empty($this->_posts_categories)) {
            return $this->_posts_categories;
        }

        $condition = 'post_id = :post_id:';
        $bind = array('post_id' => $this->_post_id);

        $posts_categories = array();

        foreach (PostsCategoriesModel::find(array($condition, 'bind' => $bind)) as $posts_category) {
            $posts_categories[] = $posts_category->category_id;
        }

        $this->_posts_categories = $posts_categories;

        return $posts_categories;
    }

    public function getCategories()
    {
        if (!empty($this->_categories)) {
            return $this->_categories;
        }

        $categories = array();

        foreach (CategoriesModel::find() as $category) {
            $categories[$category->category_id] = $category->name;
        }

        $this->_categories = $categories;

        return $categories;
    }

    public function save($post_id)
    {

        foreach ($this->getCategories() as $category_id => $name) {

            if (!empty($this->$name)) {

                $model = new \ProfitPress\Posts\Models\PostsCategories;

                $model->category_id = $category_id;
                $model->post_id = $post_id;

                if ($model->validation() && $model->save()) {
                    continue;
                } else {
                    $this->flashMessages($model, 'error');
                }
            }
        }
    }
}