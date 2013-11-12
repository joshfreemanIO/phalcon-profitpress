<?php

namespace ProfitPress\Blog\Models;

class Posts extends \ProfitPress\Components\BaseModel
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
        $this->belongsTo("users_id", "ProfitPress\Blog\Models\Users", "id");
        $this->belongsTo("categories_id", "ProfitPress\Blog\Models\Categories", "id");
    }

    public function getUsers()
    {
            return $this->getRelated('ProfitPress\Blog\Models\Users');
    }

    public function getCategories()
    {
            return $this->getRelated('ProfitPress\Blog\Models\Categories');
    }

    public function getPostLink($attribute_as_name = 'id', $attributes = array())
    {

        $link = array('uri' => "blog/posts/show/".$this->id, 'text' => $this->$attribute_as_name);
        return \ProfitPress\Components\Tag::anchor(array_merge($attributes, $link));
    }

    public function getDateModifiedDiff()
    {
        if (empty($this->date_modified))
            return false;

        $now = new \DateTime();
        $mod = new \DateTime();
        $mod->setTimeStamp(strtotime($this->date_modified));

        $interval = $mod->diff($now);

        if ($interval->s > 0) {

            $diff  = $interval->s;
            $unit = ' second';
        }

        if ($interval->i > 0) {

            $diff  = $interval->i;
            $unit = ' minute';
        }

        if ($interval->h > 0) {

            $diff  = $interval->h;
            $unit = ' hour';
        }

        if ($interval->d > 0) {

            $diff  = $interval->d;
            $unit = ' day';
        }

        if ($interval->m > 0) {

            $diff  = $interval->m;
            $unit = ' month';
        }

        if ($interval->y > 0) {

            $diff  = $interval->y;
            $unit = ' year';

        }

        $s = ($diff > 1 || $diff == 0) ? 's' : '';

        return 'Modified ' . $diff . $unit . $s . ' ago';
    }
}
